<?php

/**
 * Date: 03.01.2020
 * Time: 18:31
 */
declare(strict_types=1);

namespace Ampio\System\Utility\Traits;

use OverflowException;

/**
 * Trait Disable__set
 *
 * @package Ampio\System\Utility\Traits
 */
trait Disable__set
{
    final public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        throw new OverflowException(
            sprintf('You cannot assign a value to the "%s" parameter of the class "%s"!', $name, static::class)
        );
    }
}
