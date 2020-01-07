<?php

/**
 * Date: 03.01.2020
 * Time: 18:29
 */
declare(strict_types=1);

namespace Ampio\System\Utility\Traits;

use BadMethodCallException;

/**
 * Trait Disable__call
 *
 * @package Ampio\System\Utility\Traits
 */
trait Disable__call
{
    final public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        throw new BadMethodCallException(
            sprintf('The requested method "%s" is not defined in the class "%s"!', $name, static::class)
        );
    }
}
