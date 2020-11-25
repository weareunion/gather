<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/bigtable/admin/v2/table.proto

namespace Google\Cloud\Bigtable\Admin\V2\Table;

use UnexpectedValueException;

/**
 * Possible timestamp granularities to use when keeping multiple versions
 * of data in a table.
 *
 * Protobuf type <code>google.bigtable.admin.v2.Table.TimestampGranularity</code>
 */
class TimestampGranularity
{
    /**
     * The user did not specify a granularity. Should not be returned.
     * When specified during table creation, MILLIS will be used.
     *
     * Generated from protobuf enum <code>TIMESTAMP_GRANULARITY_UNSPECIFIED = 0;</code>
     */
    const TIMESTAMP_GRANULARITY_UNSPECIFIED = 0;
    /**
     * The table keeps data versioned at a granularity of 1ms.
     *
     * Generated from protobuf enum <code>MILLIS = 1;</code>
     */
    const MILLIS = 1;

    private static $valueToName = [
        self::TIMESTAMP_GRANULARITY_UNSPECIFIED => 'TIMESTAMP_GRANULARITY_UNSPECIFIED',
        self::MILLIS => 'MILLIS',
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
class_alias(TimestampGranularity::class, \Google\Cloud\Bigtable\Admin\V2\Table_TimestampGranularity::class);
