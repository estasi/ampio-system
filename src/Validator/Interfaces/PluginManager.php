<?php

/**
 * Date: 04.01.2020
 * Time: 14:51
 */
declare(strict_types=1);

namespace Ampio\System\Validator\Interfaces;

use Ampio\System\PluginManager\Interfaces\PluginManager as SystemPluginManagerInterface;
use Ampio\System\Validator\Interfaces\Validator as ValidatorInterface;

/**
 * Interface PluginManager
 *
 * @package Ampio\System\Validator\Interfaces
 */
interface PluginManager extends SystemPluginManagerInterface
{
    /**
     * Returns the object of the requested class by name
     *
     * @param string   $name
     * @param string[] $options
     *
     * @return ValidatorInterface
     * @throws \Ampio\System\PluginManager\Exception\NotFoundException
     * @throws \Ampio\System\PluginManager\Exception\ContainerException
     */
    public function getValidator(string $name, iterable $options = []): ValidatorInterface;
}
