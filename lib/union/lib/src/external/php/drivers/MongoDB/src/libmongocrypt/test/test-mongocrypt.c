/*
 * Copyright 2019-present MongoDB, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

#include <stdio.h>
#include <stdlib.h>

#include <bson/bson.h>

#include "mongocrypt.h"
#include "mongocrypt-config.h"
#include "mongocrypt-crypto-private.h"
#include "mongocrypt-marking-private.h"
#include "test-mongocrypt.h"


/* Return a repeated character with no null terminator. */
char *
_mongocrypt_repeat_char (char c, uint32_t times)
{
   char *result;
   uint32_t i;

   result = bson_malloc (times);
   BSON_ASSERT (result);

   for (i = 0; i < times; i++) {
      result[i] = c;
   }

   return result;
}

void
_load_json_as_bson (const char *path, bson_t *out)
{
   bson_error_t error;
   bson_json_reader_t *reader;
   bool ret;

   reader = bson_json_reader_new_from_file (path, &error);
   if (!reader) {
      fprintf (stderr, "error reading: %s\n", path);
   }
   ASSERT_OR_PRINT_BSON (reader, error);
   bson_init (out);
   ret = bson_json_reader_read (reader, out, &error);
   ASSERT_OR_PRINT_BSON (ret, error);

   bson_json_reader_destroy (reader);
}

static void
_load_json (_mongocrypt_tester_t *tester, const char *path)
{
   bson_t as_bson;
   _mongocrypt_buffer_t *buf;

   _load_json_as_bson (path, &as_bson);

   buf = &tester->file_bufs[tester->file_count];
   _mongocrypt_buffer_steal_from_bson (buf, &as_bson);
   tester->file_paths[tester->file_count] = bson_strdup (path);
   tester->file_count++;
}


static void
_load_http (_mongocrypt_tester_t *tester, const char *path)
{
   int fd;
   char *contents;
   int n_read;
   int filesize;
   char storage[512];
   int i;
   _mongocrypt_buffer_t *buf;

   filesize = 0;
   contents = NULL;
   fd = open (path, O_RDONLY);
   while ((n_read = read (fd, storage, sizeof (storage))) > 0) {
      filesize += n_read;
      /* Append storage. Performance does not matter. */
      contents = bson_realloc (contents, filesize);
      memcpy (contents + (filesize - n_read), storage, n_read);
   }

   if (n_read < 0) {
      fprintf (stderr, "failed to read %s\n", path);
      abort ();
   }

   close (fd);

   buf = &tester->file_bufs[tester->file_count];
   /* copy and fix newlines */
   _mongocrypt_buffer_init (buf);
   /* allocate twice the size since \n may become \r\n */
   buf->data = bson_malloc0 (filesize * 2);
   BSON_ASSERT (buf->data);

   buf->len = 0;
   buf->owned = true;
   for (i = 0; i < filesize; i++) {
      if (contents[i] == '\n' && contents[i - 1] != '\r') {
         buf->data[buf->len++] = '\r';
      }
      buf->data[buf->len++] = contents[i];
   }

   bson_free (contents);
   tester->file_paths[tester->file_count] = bson_strdup (path);
   tester->file_count++;
}


void
_mongocrypt_tester_install (_mongocrypt_tester_t *tester,
                            char *name,
                            _mongocrypt_test_fn fn,
                            _mongocrypt_tester_crypto_spec_t crypto_spec)
{
   bool crypto_enabled;

#ifdef MONGOCRYPT_ENABLE_CRYPTO
   crypto_enabled = true;
#else
   crypto_enabled = false;
#endif

   if (crypto_spec == CRYPTO_REQUIRED && !crypto_enabled) {
      printf ("Skipping test: %s – requires crypto to be enabled\n", name);
      return;
   }

   if (crypto_spec == CRYPTO_PROHIBITED && crypto_enabled) {
      printf ("Skipping test: %s – requires crypto to be disabled\n", name);
      return;
   }

   tester->test_fns[tester->test_count] = fn;
   tester->test_names[tester->test_count] = bson_strdup (name);
   tester->test_count++;
}


mongocrypt_binary_t *
_mongocrypt_tester_file (_mongocrypt_tester_t *tester, const char *path)
{
   int i;
   mongocrypt_binary_t *to_return;

   to_return = mongocrypt_binary_new ();
   tester->test_bin[tester->bin_count++] = to_return;

   for (i = 0; i < tester->file_count; i++) {
      if (0 == strcmp (tester->file_paths[i], path)) {
         _mongocrypt_buffer_to_binary (&tester->file_bufs[i], to_return);
         return to_return;
      }
   }

   /* File not found, load it. */
   if (strstr (path, ".json")) {
      _load_json (tester, path);
   } else if (strstr (path, ".txt")) {
      _load_http (tester, path);
   }

   _mongocrypt_buffer_to_binary (&tester->file_bufs[tester->file_count - 1],
                                 to_return);
   return to_return;
}


bson_t *
_mongocrypt_tester_bson_from_json (_mongocrypt_tester_t *tester,
                                   const char *json,
                                   ...)
{
   va_list ap;
   char *full_json;
   bson_t *bson;
   bson_error_t error;
   char *c;

   va_start (ap, json);
   full_json = bson_strdupv_printf (json, ap);
   /* Replace ' with " */
   for (c = full_json; *c; c++) {
      if (*c == '\'') {
         *c = '"';
      }
   }

   va_end (ap);
   bson = &tester->test_bson[tester->bson_count++];
   if (!bson_init_from_json (bson, full_json, strlen (full_json), &error)) {
      fprintf (stderr, "%s", error.message);
      abort ();
   }
   bson_free (full_json);
   return bson;
}


mongocrypt_binary_t *
_mongocrypt_tester_bin_from_json (_mongocrypt_tester_t *tester,
                                  const char *json,
                                  ...)
{
   va_list ap;
   char *full_json;
   bson_t *bson;
   mongocrypt_binary_t *bin;
   bson_error_t error;
   char *c;

   va_start (ap, json);
   full_json = bson_strdupv_printf (json, ap);
   /* Replace ' with " */
   for (c = full_json; *c; c++) {
      if (*c == '\'') {
         *c = '"';
      }
   }

   va_end (ap);
   bson = &tester->test_bson[tester->bson_count++];
   if (!bson_init_from_json (bson, full_json, strlen (full_json), &error)) {
      fprintf (stderr, "%s", error.message);
      abort ();
   }
   bin = mongocrypt_binary_new ();
   tester->test_bin[tester->bin_count++] = bin;
   bin->data = (uint8_t *) bson_get_data (bson);
   bin->len = bson->len;
   bson_free (full_json);
   return bin;
}


mongocrypt_binary_t *
_mongocrypt_tester_bin (_mongocrypt_tester_t *tester, int size)
{
   mongocrypt_binary_t *bin;
   uint8_t *blob;
   int i;

   if (size == 0) {
      return NULL;
   }
   blob = bson_malloc (size);
   BSON_ASSERT (blob);

   for (i = 0; i < size; i++) {
      blob[i] = (i % 3) + 1; /* 1, 2, 3, 1, 2, 3, ... */
   }

   bin = mongocrypt_binary_new_from_data (blob, size);

   tester->test_blob[tester->blob_count++] = blob;
   tester->test_bin[tester->bin_count++] = bin;
   return bin;
}

void
_mongocrypt_tester_satisfy_kms (_mongocrypt_tester_t *tester,
                                mongocrypt_kms_ctx_t *kms)
{
   const char *endpoint;

   BSON_ASSERT (mongocrypt_kms_ctx_endpoint (kms, &endpoint));
   BSON_ASSERT (endpoint == strstr (endpoint, "kms.") &&
                strstr (endpoint, ".amazonaws.com"));
   mongocrypt_kms_ctx_feed (kms,
                            TEST_FILE ("./test/example/kms-decrypt-reply.txt"));
   BSON_ASSERT (0 == mongocrypt_kms_ctx_bytes_needed (kms));
}


/* Run the state machine on example data until hitting stop_state or a
 * terminal state. */
void
_mongocrypt_tester_run_ctx_to (_mongocrypt_tester_t *tester,
                               mongocrypt_ctx_t *ctx,
                               mongocrypt_ctx_state_t stop_state)
{
   mongocrypt_ctx_state_t state;
   mongocrypt_kms_ctx_t *kms;
   mongocrypt_status_t *status;
   mongocrypt_binary_t *bin;
   bool res;

   status = mongocrypt_status_new ();
   state = mongocrypt_ctx_state (ctx);
   while (state != stop_state) {
      switch (state) {
      case MONGOCRYPT_CTX_NEED_MONGO_COLLINFO:
         BSON_ASSERT (ctx->type == _MONGOCRYPT_TYPE_ENCRYPT);
         BSON_ASSERT (mongocrypt_ctx_mongo_feed (
            ctx, TEST_FILE ("./test/example/collection-info.json")));
         BSON_ASSERT (mongocrypt_ctx_mongo_done (ctx));
         break;
      case MONGOCRYPT_CTX_NEED_MONGO_MARKINGS:
         BSON_ASSERT (ctx->type == _MONGOCRYPT_TYPE_ENCRYPT);
         res = mongocrypt_ctx_mongo_feed (
            ctx, TEST_FILE ("./test/example/mongocryptd-reply.json"));
         mongocrypt_ctx_status (ctx, status);
         ASSERT_OR_PRINT (res, status);
         BSON_ASSERT (mongocrypt_ctx_mongo_done (ctx));
         break;
      case MONGOCRYPT_CTX_NEED_MONGO_KEYS:
         res = mongocrypt_ctx_mongo_feed (
            ctx, TEST_FILE ("./test/example/key-document.json"));
         mongocrypt_ctx_status (ctx, status);
         ASSERT_OR_PRINT (res, status);
         BSON_ASSERT (mongocrypt_ctx_mongo_done (ctx));
         break;
      case MONGOCRYPT_CTX_NEED_KMS:
         kms = mongocrypt_ctx_next_kms_ctx (ctx);
         while (kms) {
            _mongocrypt_tester_satisfy_kms (tester, kms);
            kms = mongocrypt_ctx_next_kms_ctx (ctx);
         }
         res = mongocrypt_ctx_kms_done (ctx);
         mongocrypt_ctx_status (ctx, status);
         ASSERT_OR_PRINT (res, status);
         break;
      case MONGOCRYPT_CTX_READY:
         bin = mongocrypt_binary_new ();
         res = mongocrypt_ctx_finalize (ctx, bin);
         mongocrypt_ctx_status (ctx, status);
         ASSERT_OR_PRINT (res, status);
         mongocrypt_binary_destroy (bin);
         break;
      case MONGOCRYPT_CTX_ERROR:
         mongocrypt_ctx_status (ctx, status);
         fprintf (stderr,
                  "Got error: %s\n",
                  mongocrypt_status_message (status, NULL));
         BSON_ASSERT (state == stop_state);
         mongocrypt_status_destroy (status);
         return;
      case MONGOCRYPT_CTX_DONE:
         BSON_ASSERT (state == stop_state);
         mongocrypt_status_destroy (status);
         return;
      }
      state = mongocrypt_ctx_state (ctx);
   }
   BSON_ASSERT (state == stop_state);
   mongocrypt_status_destroy (status);
}


/* Get the plaintext associated with the encrypted doc for assertions. */
const char *
_mongocrypt_tester_plaintext (_mongocrypt_tester_t *tester)
{
   bson_t as_bson;
   bson_iter_t iter;
   _mongocrypt_marking_t marking;
   _mongocrypt_buffer_t buf;
   mongocrypt_status_t *status;

   BSON_ASSERT (_mongocrypt_binary_to_bson (
      TEST_FILE ("./test/example/mongocryptd-reply.json"), &as_bson));
   /* Underlying binary data lives on in tester */
   BSON_ASSERT (bson_iter_init (&iter, &as_bson));
   BSON_ASSERT (bson_iter_find_descendant (&iter, "result.filter.ssn", &iter));
   BSON_ASSERT (_mongocrypt_buffer_from_binary_iter (&buf, &iter));
   status = mongocrypt_status_new ();
   ASSERT_OR_PRINT (_mongocrypt_marking_parse_unowned (&buf, &marking, status),
                    status);
   mongocrypt_status_destroy (status);
   BSON_ASSERT (BSON_ITER_HOLDS_UTF8 (&marking.v_iter));
   return bson_iter_utf8 (&marking.v_iter, NULL);
}


mongocrypt_binary_t *
_mongocrypt_tester_encrypted_doc (_mongocrypt_tester_t *tester)
{
   mongocrypt_t *crypt;
   mongocrypt_ctx_t *ctx;
   mongocrypt_binary_t *bin;

   bin = mongocrypt_binary_new ();
   if (!_mongocrypt_buffer_empty (&tester->encrypted_doc)) {
      _mongocrypt_buffer_to_binary (&tester->encrypted_doc, bin);
      return bin;
   }

   crypt = _mongocrypt_tester_mongocrypt ();

   ctx = mongocrypt_ctx_new (crypt);
   ASSERT_OK (mongocrypt_ctx_encrypt_init (
                 ctx, "test", -1, TEST_FILE ("./test/example/cmd.json")),
              ctx);

   _mongocrypt_tester_run_ctx_to (tester, ctx, MONGOCRYPT_CTX_READY);
   mongocrypt_ctx_finalize (ctx, bin);
   _mongocrypt_buffer_copy_from_binary (&tester->encrypted_doc, bin);
   mongocrypt_ctx_destroy (ctx);
   mongocrypt_destroy (crypt);
   _mongocrypt_buffer_to_binary (&tester->encrypted_doc, bin);
   return bin;
}


void
_mongocrypt_tester_fill_buffer (_mongocrypt_buffer_t *buf, int n)
{
   uint8_t i;

   memset (buf, 0, sizeof (*buf));
   buf->data = bson_malloc (n);
   BSON_ASSERT (buf->data);

   for (i = 0; i < n; i++) {
      buf->data[i] = i;
   }
   buf->len = n;
   buf->owned = true;
}


mongocrypt_t *
_mongocrypt_tester_mongocrypt (void)
{
   mongocrypt_t *crypt;
   char localkey_data[MONGOCRYPT_KEY_LEN] = {0};
   mongocrypt_binary_t *localkey;

   crypt = mongocrypt_new ();
   mongocrypt_setopt_log_handler (crypt, _mongocrypt_stdout_log_fn, NULL);
   mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, "example", -1);
   localkey = mongocrypt_binary_new_from_data ((uint8_t *) localkey_data,
                                               sizeof localkey_data);
   mongocrypt_setopt_kms_provider_local (crypt, localkey);
   mongocrypt_binary_destroy (localkey);
   ASSERT_OK (mongocrypt_init (crypt), crypt);
   return crypt;
}


static void
_test_mongocrypt_bad_init (_mongocrypt_tester_t *tester)
{
   mongocrypt_t *crypt;
   mongocrypt_binary_t *local_key;
   char tmp;


   /* Omitting a KMS provider must fail. */
   crypt = mongocrypt_new ();
   ASSERT_FAILS (mongocrypt_init (crypt), crypt, "no kms provider set");
   mongocrypt_destroy (crypt);

   /* Bad KMS provider options must fail. */
   crypt = mongocrypt_new ();
   ASSERT_FAILS (
      mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, NULL, -1),
      crypt,
      "invalid aws secret access key");
   mongocrypt_destroy (crypt);

   crypt = mongocrypt_new ();
   ASSERT_FAILS (
      mongocrypt_setopt_kms_provider_aws (crypt, NULL, -1, "example", -1),
      crypt,
      "invalid aws access key id");
   mongocrypt_destroy (crypt);

   /* Malformed UTF8 */
   /* An orphaned UTF-8 continuation byte (10xxxxxx) is malformed UTF-8. */
   tmp = (char) 0x80;
   crypt = mongocrypt_new ();
   ASSERT_FAILS (
      mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, &tmp, 1),
      crypt,
      "invalid aws secret access key");
   mongocrypt_destroy (crypt);

   crypt = mongocrypt_new ();
   ASSERT_FAILS (mongocrypt_setopt_kms_provider_local (crypt, NULL),
                 crypt,
                 "passed null key");
   mongocrypt_destroy (crypt);

   crypt = mongocrypt_new ();
   local_key = mongocrypt_binary_new ();
   ASSERT_FAILS (mongocrypt_setopt_kms_provider_local (crypt, local_key),
                 crypt,
                 "local key must be 96 bytes");
   mongocrypt_binary_destroy (local_key);
   mongocrypt_destroy (crypt);

   /* Reinitialization must fail. */
   crypt = mongocrypt_new ();
   ASSERT_OK (
      mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, "example", -1),
      crypt);
   ASSERT_OK (mongocrypt_init (crypt), crypt);
   ASSERT_FAILS (mongocrypt_init (crypt), crypt, "already initialized");
   mongocrypt_destroy (crypt);
   /* Setting options after initialization must fail. */
   crypt = mongocrypt_new ();
   ASSERT_OK (
      mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, "example", -1),
      crypt);
   ASSERT_OK (mongocrypt_init (crypt), crypt);
   ASSERT_FAILS (
      mongocrypt_setopt_kms_provider_aws (crypt, "example", -1, "example", -1),
      crypt,
      "options cannot be set after initialization");
   mongocrypt_destroy (crypt);
}


void
_assert_bin_bson_equal (mongocrypt_binary_t *bin_a, mongocrypt_binary_t *bin_b)
{
   bson_t bin_a_bson, bin_b_bson;
   BSON_ASSERT (_mongocrypt_binary_to_bson (bin_a, &bin_a_bson));
   BSON_ASSERT (_mongocrypt_binary_to_bson (bin_b, &bin_b_bson));
   char *str_a = bson_as_canonical_extended_json (&bin_a_bson, NULL);
   char *str_b = bson_as_canonical_extended_json (&bin_b_bson, NULL);
   char *msg = bson_strdup_printf ("BSON unequal:%s\n!=\n%s\n", str_a, str_b);
   bson_free (str_a);
   bson_free (str_b);
   ASSERT_OR_PRINT_MSG (bson_equal (&bin_a_bson, &bin_b_bson), msg);
   bson_free (msg);
}


static void
_test_setopt_schema (_mongocrypt_tester_t *tester)
{
   mongocrypt_t *crypt;

   /* Test double setting. */
   crypt = mongocrypt_new ();
   ASSERT_OK (mongocrypt_setopt_schema_map (
                 crypt, TEST_FILE ("./test/data/schema-map.json")),
              crypt);
   ASSERT_FAILS (mongocrypt_setopt_schema_map (
                    crypt, TEST_FILE ("./test/data/schema-map.json")),
                 crypt,
                 "already set schema");

   /* Test NULL/empty input */
   mongocrypt_destroy (crypt);
   crypt = mongocrypt_new ();
   ASSERT_FAILS (
      mongocrypt_setopt_schema_map (crypt, NULL), crypt, "passed null schema");

   mongocrypt_destroy (crypt);
   crypt = mongocrypt_new ();
   ASSERT_FAILS (mongocrypt_setopt_schema_map (crypt, TEST_BIN (0)),
                 crypt,
                 "passed null schema");

   /* Test malformed BSON */
   mongocrypt_destroy (crypt);
   crypt = mongocrypt_new ();
   ASSERT_FAILS (mongocrypt_setopt_schema_map (crypt, TEST_BIN (10)),
                 crypt,
                 "invalid bson");
   mongocrypt_destroy (crypt);
}

static void
_test_setopt_invalid_kms_providers (_mongocrypt_tester_t *tester)
{
   mongocrypt_t *crypt;
   mongocrypt_ctx_t *ctx;
   mongocrypt_status_t *status;

   crypt = mongocrypt_new ();
   ASSERT_OK (mongocrypt_setopt_kms_provider_aws (crypt, "", 0, "", 0), crypt);
   ASSERT_OK (mongocrypt_init (crypt), crypt);

   ctx = mongocrypt_ctx_new (crypt);
   ASSERT_OK (mongocrypt_ctx_setopt_masterkey_aws (ctx, "region", -1, "cmk", 3),
              ctx);
   mongocrypt_ctx_datakey_init (ctx);
   _mongocrypt_tester_run_ctx_to (tester, ctx, MONGOCRYPT_CTX_ERROR);

   status = mongocrypt_status_new ();
   BSON_ASSERT (!mongocrypt_ctx_status (ctx, status));
   ASSERT_STATUS_CONTAINS (status, "failed to create KMS message");

   mongocrypt_status_destroy (status);
   mongocrypt_ctx_destroy (ctx);
   mongocrypt_destroy (crypt);
}


int
main (int argc, char **argv)
{
   _mongocrypt_tester_t tester = {0};
   int i;

   printf ("Pass a list of test names to run only specific tests. E.g.:\n");
   printf ("test-mongocrypt _mongocrypt_test_mcgrew\n\n");

   /* Install all tests. */
   _mongocrypt_tester_install_crypto (&tester);
   _mongocrypt_tester_install_log (&tester);
   _mongocrypt_tester_install_data_key (&tester);
   _mongocrypt_tester_install_ctx_encrypt (&tester);
   _mongocrypt_tester_install_ctx_decrypt (&tester);
   _mongocrypt_tester_install_ciphertext (&tester);
   _mongocrypt_tester_install_key_broker (&tester);
   _mongocrypt_tester_install (&tester,
                               "_test_mongocrypt_bad_init",
                               _test_mongocrypt_bad_init,
                               CRYPTO_REQUIRED);
   _mongocrypt_tester_install_local_kms (&tester);
   _mongocrypt_tester_install_cache (&tester);
   _mongocrypt_tester_install_buffer (&tester);
   _mongocrypt_tester_install_ctx_setopt (&tester);
   _mongocrypt_tester_install_key (&tester);
   _mongocrypt_tester_install_marking (&tester);
   _mongocrypt_tester_install_traverse_util (&tester);
   _mongocrypt_tester_install (
      &tester, "_test_setopt_schema", _test_setopt_schema, CRYPTO_REQUIRED);
   _mongocrypt_tester_install (&tester,
                               "_test_setopt_invalid_kms_providers",
                               _test_setopt_invalid_kms_providers,
                               CRYPTO_REQUIRED);
   _mongocrypt_tester_install_crypto_hooks (&tester);
   _mongocrypt_tester_install_key_cache (&tester);
   _mongocrypt_tester_install_kms_responses (&tester);
   _mongocrypt_tester_install_status (&tester);


   printf ("Running tests...\n");
   for (i = 0; tester.test_names[i]; i++) {
      int j;
      bool found = false;

      if (argc > 1) {
         for (j = 1; j < argc; j++) {
            found = (0 == strcmp (argv[j], tester.test_names[i]));
            if (found)
               break;
         }
         if (!found) {
            continue;
         }
      }
      printf ("  begin %s\n", tester.test_names[i]);
      tester.test_fns[i](&tester);
      printf ("  end %s\n", tester.test_names[i]);
   }
   printf ("... done running tests\n");

   if (i == 0) {
      printf ("WARNING - no tests run.\n");
   }

   /* Clean up tester. */
   for (i = 0; i < tester.test_count; i++) {
      bson_free (tester.test_names[i]);
   }

   for (i = 0; i < tester.file_count; i++) {
      _mongocrypt_buffer_cleanup (&tester.file_bufs[i]);
      bson_free (tester.file_paths[i]);
   }

   for (i = 0; i < tester.bin_count; i++) {
      mongocrypt_binary_destroy (tester.test_bin[i]);
   }

   for (i = 0; i < tester.bson_count; i++) {
      bson_destroy (&tester.test_bson[i]);
   }

   for (i = 0; i < tester.blob_count; i++) {
      bson_free (tester.test_blob[i]);
   }

   _mongocrypt_buffer_cleanup (&tester.encrypted_doc);
}
