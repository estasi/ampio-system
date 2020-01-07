<?php

/**
 * Date: 06.01.2020
 * Time: 2:25
 */
declare(strict_types=1);

namespace Ampio\System\Translator\Traits;

/**
 * Trait GetPluginsData
 *
 * @package Ampio\System\Translator\Traits
 */
trait GetPluginsData
{
    /**
     * @inheritDoc
     */
    public function getPluginsData(): array
    {
        $result = [];
        $factories = $this->getPluginFactories();
        foreach ($this->plugins as $plugin => $data) {
            $factory[self::FACTORY] = $factories[$plugin] ?? $factories[self::DEFAULT_FACTORY];
            $result[$plugin] = array_merge($data, $factory);
        }
        
        return $result;
    }
}
