<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2\InspectDataSourceDetails;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Snapshot of the inspection configuration.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.InspectDataSourceDetails.RequestedOptions</code>
 */
class RequestedOptions extends \Google\Protobuf\Internal\Message
{
    /**
     * If run with an InspectTemplate, a snapshot of its state at the time of
     * this run.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectTemplate snapshot_inspect_template = 1;</code>
     */
    private $snapshot_inspect_template = null;
    /**
     * Inspect config.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectJobConfig job_config = 3;</code>
     */
    private $job_config = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Dlp\V2\InspectTemplate $snapshot_inspect_template
     *           If run with an InspectTemplate, a snapshot of its state at the time of
     *           this run.
     *     @type \Google\Cloud\Dlp\V2\InspectJobConfig $job_config
     *           Inspect config.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct($data);
    }

    /**
     * If run with an InspectTemplate, a snapshot of its state at the time of
     * this run.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectTemplate snapshot_inspect_template = 1;</code>
     * @return \Google\Cloud\Dlp\V2\InspectTemplate
     */
    public function getSnapshotInspectTemplate()
    {
        return $this->snapshot_inspect_template;
    }

    /**
     * If run with an InspectTemplate, a snapshot of its state at the time of
     * this run.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectTemplate snapshot_inspect_template = 1;</code>
     * @param \Google\Cloud\Dlp\V2\InspectTemplate $var
     * @return $this
     */
    public function setSnapshotInspectTemplate($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\InspectTemplate::class);
        $this->snapshot_inspect_template = $var;

        return $this;
    }

    /**
     * Inspect config.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectJobConfig job_config = 3;</code>
     * @return \Google\Cloud\Dlp\V2\InspectJobConfig
     */
    public function getJobConfig()
    {
        return $this->job_config;
    }

    /**
     * Inspect config.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InspectJobConfig job_config = 3;</code>
     * @param \Google\Cloud\Dlp\V2\InspectJobConfig $var
     * @return $this
     */
    public function setJobConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\InspectJobConfig::class);
        $this->job_config = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(RequestedOptions::class, \Google\Cloud\Dlp\V2\InspectDataSourceDetails_RequestedOptions::class);
