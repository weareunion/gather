<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v1p1beta1/cloud_speech.proto

namespace Google\Cloud\Speech\V1p1beta1\StreamingRecognizeResponse;

use UnexpectedValueException;

/**
 * Indicates the type of speech event.
 *
 * Protobuf type <code>google.cloud.speech.v1p1beta1.StreamingRecognizeResponse.SpeechEventType</code>
 */
class SpeechEventType
{
    /**
     * No speech event specified.
     *
     * Generated from protobuf enum <code>SPEECH_EVENT_UNSPECIFIED = 0;</code>
     */
    const SPEECH_EVENT_UNSPECIFIED = 0;
    /**
     * This event indicates that the server has detected the end of the user's
     * speech utterance and expects no additional speech. Therefore, the server
     * will not process additional audio (although it may subsequently return
     * additional results). The client should stop sending additional audio
     * data, half-close the gRPC connection, and wait for any additional results
     * until the server closes the gRPC connection. This event is only sent if
     * `single_utterance` was set to `true`, and is not used otherwise.
     *
     * Generated from protobuf enum <code>END_OF_SINGLE_UTTERANCE = 1;</code>
     */
    const END_OF_SINGLE_UTTERANCE = 1;

    private static $valueToName = [
        self::SPEECH_EVENT_UNSPECIFIED => 'SPEECH_EVENT_UNSPECIFIED',
        self::END_OF_SINGLE_UTTERANCE => 'END_OF_SINGLE_UTTERANCE',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SpeechEventType::class, \Google\Cloud\Speech\V1p1beta1\StreamingRecognizeResponse_SpeechEventType::class);

