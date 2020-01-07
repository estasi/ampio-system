<?php

/**
 * Date: 04.01.2020
 * Time: 13:37
 */
declare(strict_types=1);

namespace Ampio\System\Filter\Interfaces;

use Ampio\System\Filter\Interfaces\Filter as FilterInterface;
use Ampio\System\PluginManager\Interfaces\PluginManager as SystemPluginManagerInterface;

/**
 * Interface PluginManager
 *
 * @package Ampio\System\Filter\Interfaces
 */
interface PluginManager extends SystemPluginManagerInterface
{
    /**
     * @param string   $name
     * @param string[] $options
     *
     * @return FilterInterface
     * @throws \Ampio\System\PluginManager\Exception\NotFoundException
     * @throws \Ampio\System\PluginManager\Exception\ContainerException
     * @api
     */
    public function getFilter(string $name, iterable $options = []): FilterInterface;
}
