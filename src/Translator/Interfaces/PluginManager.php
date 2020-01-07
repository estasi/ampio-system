<?php

/**
 * Date: 05.01.2020
 * Time: 20:42
 */
declare(strict_types=1);

namespace Ampio\System\Translator\Interfaces;

use Ampio\System\PluginManager\Interfaces\PluginManager as SystemPluginManagerInterface;
use Ampio\System\Translator\Interfaces\Translator as TranslatorInterface;

/**
 * Interface PluginManager
 *
 * @package Ampio\System\Translator\Interfaces
 */
interface PluginManager extends SystemPluginManagerInterface
{
    /**
     * Returns a translator class object that implements the \Ampio\System\Translator\Interfaces\Translator interface
     *
     * @param string   $name
     * @param string   $locale
     * @param iterable $options
     *
     * @return \Ampio\System\Translator\Interfaces\Translator
     * @throws \Ampio\System\PluginManager\Exception\NotFoundException
     * @throws \Ampio\System\PluginManager\Exception\ContainerException
     */
    public function getTranslator(string $name, string $locale, iterable $options = []): TranslatorInterface;
}
