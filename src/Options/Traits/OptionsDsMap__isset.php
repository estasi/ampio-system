<?php

/**
 * Date: 03.01.2020
 * Time: 18:50
 */
declare(strict_types=1);

namespace Ampio\System\Options\Traits;

/**
 * Trait OptionsDsMap__isset
 *
 * @package Ampio\System\Options\Traits
 */
trait OptionsDsMap__isset
{
    final public function __isset($name)
    {
        // TODO: Implement __isset() method.
        return $this->options->hasKey($name);
    }
}
