<?php

/**
 * Date: 03.01.2020
 * Time: 19:23
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Traits;

use Ampio\System\Utility\ArrayUtils;

/**
 * Trait OptionsFromArguments__call
 *
 * @package Ampio\System\PluginManager\Traits
 */
trait OptionsFromArguments__call
{
    /**
     * @param string $name
     * @param array  $arguments
     * @param string $adapterType
     *
     * @return array
     */
    protected function getOptionsFromArguments(string $name, array $arguments, string $adapterType): array
    {
        if (preg_match('`adapter$`i', $name)) {
            $options[$adapterType] = $arguments[0];
        } else {
            $options = [];
            if (count($arguments)) {
                $tmp = $arguments[0];
                if (is_iterable($tmp)) {
                    /** @var iterable $tmp */
                    $options = ArrayUtils::iteratorToArray($tmp);
                }
            }
        }

        return $options;
    }
}
