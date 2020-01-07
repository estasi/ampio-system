<?php

/**
 * Date: 03.01.2020
 * Time: 18:50
 */
declare(strict_types=1);

namespace Ampio\System\Options\Traits;

use OutOfBoundsException;

/**
 * Trait OptionsDsMap__get
 *
 * @package Ampio\System\Options\Traits
 */
trait OptionsDsMap__get
{
    final public function __get($name)
    {
        // TODO: Implement __get() method.
        if ($this->options->hasKey($name)) {
            return $this->options->get($name);
        }

        throw new OutOfBoundsException(
            sprintf('The "%s" property of the class "%s" is undefined!', $name, static::class)
        );
    }
}
