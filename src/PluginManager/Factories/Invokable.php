<?php

/**
 * Date: 21.12.2019
 * Time: 12:04
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Factories;

use Ampio\System\PluginManager\Interfaces\Factory;

/**
 * Class Invokable
 *
 * @package Ampio\System\PluginManager\Factories
 */
final class Invokable implements Factory
{
    /**
     * @inheritDoc
     */
    public function __invoke(string $class, array $options = null): object
    {
        // TODO: Implement __invoke() method.
        return $options ? new $class($options) : new $class();
    }
}
