<?php

/**
 * Date: 05.01.2020
 * Time: 15:28
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Factories\Traits;

use Ampio\System\Utility\StringUtils;
use OutOfBoundsException;
use ReflectionClass;

/**
 * Trait Reflection
 *
 * Determines what class constructor parameters are needed to create an object. Checks for their presence in the passed
 * options array, if the required parameters are missing, then throws an \OutOfBoundsException(). From the
 * received parameters from the passed options creates an object
 *
 * @package Ampio\System\PluginManager\Factories\Traits
 */
trait Reflection
{
    /**
     * @param string     $className
     * @param array|null $options
     *
     * @return object
     * @throws \ReflectionException
     */
    protected function newInstanceArgs(string $className, ?array $options = null)
    {
        $refClass = new ReflectionClass($className);

        $args    = [];
        $options = boolval($options) ? $this->parametersNameInCamelCase($options) : [];
        [$requiredArgs, $optionalArgs] = $this->reflectionRequiredAndOptionalArgsWithDefaultValues(
            $refClass->getConstructor()
                     ->getParameters()
        );
        $this->checkRequiredArgs($requiredArgs, $options, $args, $className);
        $this->checkOptionalArgs($optionalArgs, $options, $args);
        $this->checkOptionsArgs($requiredArgs, $optionalArgs, $options, $args);

        return $refClass->newInstanceArgs($args);
    }

    /**
     * converts parameter names to camelCase
     *
     * @param array $options
     *
     * @return array
     */
    private function parametersNameInCamelCase(array $options): array
    {
        $result = [];
        foreach ($options as $key => $value) {
            $result[StringUtils::separatorToCamelCase($key)] = $value;
        }

        return $result;
    }

    /**
     * @param \ReflectionParameter[] $constructorParameters
     *
     * @return array[]
     * @throws \ReflectionException
     */
    private function reflectionRequiredAndOptionalArgsWithDefaultValues(array $constructorParameters): array
    {
        $requiredArgs = [];
        $optionalArgs = [];
        foreach ($constructorParameters as $param) {
            $nameArg = $param->getName();

            if (false === $param->isOptional()) {
                $requiredArgs[$nameArg] = true;
                continue;
            }

            if (0 !== strcmp($nameArg, 'options')) {
                $optionalArgs[$nameArg] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                continue;
            }
        }

        return [$requiredArgs, $optionalArgs];
    }

    /**
     * @param array  $requiredArgs
     * @param array  $options
     * @param array  $args
     *
     * @param string $className
     *
     * @throws \OutOfBoundsException
     */
    private function checkRequiredArgs(array $requiredArgs, array $options, array &$args, string $className): void
    {
        $numberOfRequiredParams = count($requiredArgs);
        if ($numberOfRequiredParams) {
            $args = array_intersect_key($options, $requiredArgs);

            if ($numberOfRequiredParams !== count($args)) {
                $missingRequiredArgs = array_diff_key($requiredArgs, $args);
                throw new OutOfBoundsException(
                    sprintf(
                        'Required parameter "%s", to create a class object "%s" is not specified!',
                        array_key_first($missingRequiredArgs),
                        $className
                    )
                );
            }
        }
    }

    /**
     * @param array $optionalArgs
     * @param array $options
     * @param array $args
     */
    private function checkOptionalArgs(array $optionalArgs, array $options, array &$args): void
    {
        $changedDefaultValues = array_merge($optionalArgs, $options);
        $onlyOptionalArgs     = array_intersect_key($changedDefaultValues, $optionalArgs);
        $args                 = array_merge($args, $onlyOptionalArgs);
    }

    /**
     * @param array $requiredArgs
     * @param array $optionalArgs
     * @param array $options
     * @param array $args
     */
    private function checkOptionsArgs(array $requiredArgs, array $optionalArgs, array $options, array &$args): void
    {
        $undeclaredArgs = array_diff_key($options, $requiredArgs, $optionalArgs);
        if (boolval($undeclaredArgs)) {
            $args['options'] = $undeclaredArgs;
        }
    }
}
