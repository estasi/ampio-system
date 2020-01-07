<?php

/**
 * Date: 25.11.2019
 * Time: 14:44
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

/**
 * Class Variable
 *
 * @package Ampio\System\Utility
 */
abstract class Variable
{
    public const BOOLEAN      = 'boolean';
    public const INTEGER      = 'integer';
    public const DOUBLE       = 'double';
    public const STRING       = 'string';
    public const ARRAY        = 'array';
    public const OBJECT       = 'object';
    public const RESOURCE     = 'resource';
    public const NULL         = 'null';
    public const UNKNOWN_TYPE = 'unknown type';
    
    /**
     * @param mixed  $var
     * @param string ...$types
     *
     * @return bool
     */
    public static function isType($var, string ...$types): bool
    {
        return in_array(gettype($var), $types);
    }
    
    /**
     * @param mixed  $var
     * @param string ...$types
     *
     * @return bool
     */
    public static function notType($var, string ...$types): bool
    {
        return !self::isType($var, ...$types);
    }
    
    /**
     * Returns a parsable string representation of a variable
     *
     * @param mixed $var
     *
     * @return string string information about this variable
     */
    public static function exportToString($var): string
    {
        switch (gettype($var)) {
            case self::OBJECT:
                $result = method_exists($var, '__toString') ? (string)$var : get_class($var);
                break;
            case self::ARRAY:
                $result = sprintf('Array(%d)', count($var));
                break;
            case self::BOOLEAN:
                $result = var_export($var, true);
                break;
            case self::NULL:
                $result = 'NULL';
                break;
            case self::RESOURCE:
                $result = sprintf("Resource(%s)", get_resource_type($var));
                break;
            case self::UNKNOWN_TYPE:
                $result = self::UNKNOWN_TYPE;
                break;
            default:
                $result = (string)$var;
                break;
        }
        
        return $result;
    }
}
