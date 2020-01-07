<?php

/**
 * Date: 27.11.2019
 * Time: 15:02
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Abstracts;

use Ampio\System\PluginManager\Exception\ContainerException;
use Ampio\System\PluginManager\Exception\NotFoundException;
use Ampio\System\PluginManager\Interfaces;
use Ampio\System\Utility\Variable;
use Ds\Map;

/**
 * Class PluginManager
 *
 * @package Ampio\System\PluginManager\Absrtacts
 */
abstract class PluginManager implements Interfaces\PluginManager
{
    /** @var \Ds\Map */
    private static Map $plugins;

    /**
     * PluginManager constructor.
     */
    public function __construct()
    {
        if (false === isset(self::$plugins)) {
            self::$plugins = new Map();
        }
    }

    /**
     * @inheritDoc
     */
    public function has($id): bool
    {
        // TODO: Implement has() method.
        [$className] = $this->getClassNameAndFactory($id);

        return null !== $className;
    }

    /**
     * @inheritDoc
     */
    public function get($id): object
    {
        // TODO: Implement get() method.
        return $this->build($id);
    }

    /**
     * Returns an object of the requested class with the passed parameters in the constructor
     *
     * @param string     $id
     * @param array|null $options
     *
     * @return object
     * @api
     */
    public function build(string $id, array $options = null): object
    {
        [$className, $factory] = $this->getClassNameAndFactory($id);

        if (null === $className) {
            throw new NotFoundException(
                sprintf('A plugin by the name "%s" was not found in the PluginManager "%s"!', $id, static::class)
            );
        }

        if (false === class_exists($className)) {
            throw new ContainerException(
                sprintf('Plugin named "%s" cannot be created! The plugin class "%s" not found!', $id, $className)
            );
        }

        $this->checkFactory($factory);
        $plugin  = $factory($className, $options);

        $instanceOf = $this->getInstanceOf();
        if ($instanceOf && false === is_subclass_of($plugin, $instanceOf)) {
            throw new ContainerException(sprintf('The plugin class "%s" is not an instance of %s"', $id, $instanceOf));
        }

        return $plugin;
    }

    /**
     * @param string $id
     *
     * @return string[]
     */
    private function getClassNameAndFactory(string $id): array
    {
        if ($this->hasInCache($id)) {
            $classNameAndFactory = $this->getFromCache($id);
            goto _return_;
        }

        $className = null;
        $factory   = null;
        $names     = $this->getPluginsData();

        if (array_key_exists($id, $names)) {
            $className = $id;
            $factory   = $names[$id][self::FACTORY];
        } else {
            foreach ($names as $name => [self::ALIASES => $alias, self::FACTORY => $tmpFactory]) {
                if (in_array($id, $alias)) {
                    $className = $name;
                    $factory   = $tmpFactory;
                    break;
                }
            }
        }

        $classNameAndFactory = [$className, $factory];
        $this->setToCache($id, $classNameAndFactory);

        _return_:

        return $classNameAndFactory;
    }

    /**
     * returns the class object creation factory or null if it is not defined
     *
     * @param string|callable $factory
     */
    private function checkFactory(&$factory): void
    {
        // TODO: Implement getFactory() method.
        if (is_string($factory) && class_exists($factory, false)
            && is_subclass_of($factory, Interfaces\Factory::class)) {
            $factory = new $factory();
        }

        if (false === is_callable($factory)) {
            throw new NotFoundException(
                sprintf('Unable to resolve service "%s" to a factory!', Variable::exportToString($factory))
            );
        }
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    private function hasInCache(string $id): bool
    {
        return self::$plugins->hasKey($id);
    }

    /**
     * @param string $id
     *
     * @return array
     */
    private function getFromCache(string $id): array
    {
        return self::$plugins->get($id, [null, null]);
    }

    /**
     * @param string $id
     * @param array  $data
     */
    private function setToCache(string $id, array $data): void
    {
        self::$plugins->put($id, $data);
    }
}
