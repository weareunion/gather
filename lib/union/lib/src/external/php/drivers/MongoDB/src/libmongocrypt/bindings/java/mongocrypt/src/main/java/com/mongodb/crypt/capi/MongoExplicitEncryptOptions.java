/*
 * Copyright 2008-present MongoDB, Inc.
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
 *
 */

package com.mongodb.crypt.capi;

import org.bson.BsonBinary;

/**
 * Options for explicit encryption.
 */
public class MongoExplicitEncryptOptions {
    private final BsonBinary keyId;
    private final String keyAltName;
    private final String algorithm;

    /**
     * The builder for the options
     */
    public static class Builder {
        private BsonBinary keyId;
        private String keyAltName;
        private String algorithm;

        private Builder() {
        }

        /**
         * Add the key identifier.
         *
         * @param keyId the key idenfifier
         * @return this
         */
        public Builder keyId(final BsonBinary keyId) {
            this.keyId = keyId;
            return this;
        }

        /**
         * Add the key alternative name.
         *
         * @param keyAltName the key alternative name
         * @return this
         */
        public Builder keyAltName(final String keyAltName) {
            this.keyAltName = keyAltName;
            return this;
        }

        /**
         * Add the encryption algorithm.
         *
         * @param algorithm the encryption algorithm
         * @return this
         */
        public Builder algorithm(final String algorithm) {
            this.algorithm = algorithm;
            return this;
        }

        /**
         * Build the options.
         *
         * @return the options
         */
        public MongoExplicitEncryptOptions build() {
            return new MongoExplicitEncryptOptions(this);
        }
    }

    /**
     * Create a builder for the options.
     * 
     * @return the builder
     */
    public static Builder builder() {
        return new Builder();
    }

    /**
     * Gets the key identifier
     * @return the key identifier
     */
    public BsonBinary getKeyId() {
        return keyId;
    }

    /**
     * Gets the key alternative name
     * @return the key alternative name
     */
    public String getKeyAltName() {
        return keyAltName;
    }

    /**
     * Gets the encryption algorithm
     * @return the encryption algorithm
     */
    public String getAlgorithm() {
        return algorithm;
    }

    private MongoExplicitEncryptOptions(Builder builder) {
        this.keyId = builder.keyId;
        this.keyAltName = builder.keyAltName;
        this.algorithm = builder.algorithm;
    }

    @Override
    public String toString() {
        return "MongoExplicitEncryptOptions{" +
                "keyId=" + keyId +
                ", keyAltName=" + keyAltName +
                ", algorithm='" + algorithm + "'}";
    }
}
