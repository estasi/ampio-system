<?php

/**
 * Date: 03.01.2020
 * Time: 18:54
 */
declare(strict_types=1);

namespace Ampio\System\Options\Traits;

/**
 * Trait OptionsDsMapWith
 *
 * @package Ampio\System\Options\Traits
 */
trait OptionsDsMapWith
{
    /**
     * Returns a new instance that has the changed option value
     *
     * @param string $nameOpt option name
     * @param mixed  $value   options value
     *
     * @return $this new an instance
     */
    final protected function with(string $nameOpt, $value): self
    {
        $new = clone $this;
        $new->options->put($nameOpt, $value);
        
        return $new;
    }
}
