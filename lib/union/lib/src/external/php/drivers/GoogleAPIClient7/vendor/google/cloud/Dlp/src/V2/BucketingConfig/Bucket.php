<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2\BucketingConfig;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Bucket is represented as a range, along with replacement values.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.BucketingConfig.Bucket</code>
 */
class Bucket extends \Google\Protobuf\Internal\Message
{
    /**
     * Lower bound of the range, inclusive. Type should be the same as max if
     * used.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value min = 1;</code>
     */
    private $min = null;
    /**
     * Upper bound of the range, exclusive; type must match min.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value max = 2;</code>
     */
    private $max = null;
    /**
     * Required. Replacement value for this bucket.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value replacement_value = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $replacement_value = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Dlp\V2\Value $min
     *           Lower bound of the range, inclusive. Type should be the same as max if
     *           used.
     *     @type \Google\Cloud\Dlp\V2\Value $max
     *           Upper bound of the range, exclusive; type must match min.
     *     @type \Google\Cloud\Dlp\V2\Value $replacement_value
     *           Required. Replacement value for this bucket.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct($data);
    }

    /**
     * Lower bound of the range, inclusive. Type should be the same as max if
     * used.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value min = 1;</code>
     * @return \Google\Cloud\Dlp\V2\Value
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Lower bound of the range, inclusive. Type should be the same as max if
     * used.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value min = 1;</code>
     * @param \Google\Cloud\Dlp\V2\Value $var
     * @return $this
     */
    public function setMin($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\Value::class);
        $this->min = $var;

        return $this;
    }

    /**
     * Upper bound of the range, exclusive; type must match min.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value max = 2;</code>
     * @return \Google\Cloud\Dlp\V2\Value
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Upper bound of the range, exclusive; type must match min.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value max = 2;</code>
     * @param \Google\Cloud\Dlp\V2\Value $var
     * @return $this
     */
    public function setMax($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\Value::class);
        $this->max = $var;

        return $this;
    }

    /**
     * Required. Replacement value for this bucket.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value replacement_value = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Dlp\V2\Value
     */
    public function getReplacementValue()
    {
        return $this->replacement_value;
    }

    /**
     * Required. Replacement value for this bucket.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.Value replacement_value = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Dlp\V2\Value $var
     * @return $this
     */
    public function setReplacementValue($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\Value::class);
        $this->replacement_value = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Bucket::class, \Google\Cloud\Dlp\V2\BucketingConfig_Bucket::class);

