<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/resource.proto

namespace Google\Api\ResourceDescriptor;

use UnexpectedValueException;

/**
 * A flag representing a specific style that a resource claims to conform to.
 *
 * Protobuf type <code>google.api.ResourceDescriptor.Style</code>
 */
class Style
{
    /**
     * The unspecified value. Do not use.
     *
     * Generated from protobuf enum <code>STYLE_UNSPECIFIED = 0;</code>
     */
    const STYLE_UNSPECIFIED = 0;
    /**
     * This resource is intended to be "declarative-friendly".
     * Declarative-friendly resources must be more strictly consistent, and
     * setting this to true communicates to tools that this resource should
     * adhere to declarative-friendly expectations.
     * Note: This is used by the API linter (linter.aip.dev) to enable
     * additional checks.
     *
     * Generated from protobuf enum <code>DECLARATIVE_FRIENDLY = 1;</code>
     */
    const DECLARATIVE_FRIENDLY = 1;

    private static $valueToName = [
        self::STYLE_UNSPECIFIED => 'STYLE_UNSPECIFIED',
        self::DECLARATIVE_FRIENDLY => 'DECLARATIVE_FRIENDLY',
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


