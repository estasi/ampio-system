<?php

/**
 * Date: 21.12.2019
 * Time: 12:02
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Interfaces;

/**
 * Interface Factory
 *
 * @package Ampio\System\PluginManager\Interfaces
 */
interface Factory
{
    /**
     * @param string     $class
     * @param array|null $options
     *
     * @return object
     */
    public function __invoke(string $class, array $options = null): object;
}
