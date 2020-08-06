--TEST--
Timestamp type: Timestamp with high-order bit set on both seconds and increment
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('10000000116100FFFFFFFFFFFFFFFF00');
$canonicalExtJson = '{"a" : {"$timestamp" : {"t" : 4294967295, "i" :  4294967295} } }';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
10000000116100ffffffffffffffff00
{"a":{"$timestamp":{"t":4294967295,"i":4294967295}}}
10000000116100ffffffffffffffff00
===DONE===