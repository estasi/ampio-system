<?php

/**
 * Date: 03.01.2020
 * Time: 18:30
 */
declare(strict_types=1);

namespace Ampio\System\Utility\Traits;

use BadMethodCallException;

/**
 * Trait Disable__callStatic
 *
 * @package Ampio\System\Utility\Traits
 */
trait Disable__callStatic
{
    final public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        throw new BadMethodCallException(
            sprintf('The requested static method "%s" is not defined in the class "%s"!', $name, static::class)
        );
    }
}
