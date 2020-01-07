<?php

/**
 * Date: 27.11.2019
 * Time: 14:59
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Interfaces;

use Psr\Container\ContainerInterface;

/**
 * Interface PluginManager
 *
 * @package Ampio\System\PluginManager\Interfaces
 */
interface PluginManager extends ContainerInterface
{
    // Required plugin array keys
    public const ALIASES = 'aliases';
    public const FACTORY = 'factory';

    // Required array key returned by self::getPluginFactories() method for dynamically creating an array of plugins
    public const DEFAULT_FACTORY = 'defaultFactory';

    /**
     * Returns the data of the plugins in the format
     * array("pluginName" => array("aliases" => array(...), "factory" * => "factoryName"))
     *
     * @return string[]
     * @internal
     */
    public function getPluginsData(): array;

    /**
     * Returns an object type that the created instance must be instanced of
     *
     * @return string|null
     * @internal
     */
    public function getInstanceOf(): ?string;

    /**
     * Returns the main plugin creation factory
     *
     * @return string[]|callable[]
     * @internal
     */
    public function getPluginFactories(): array;
}
