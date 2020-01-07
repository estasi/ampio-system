<?php

/**
 * Date: 30.11.2019
 * Time: 23:14
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

use Ampio\System\Filter\Interfaces\Chain as FilterChainInterface;
use Ampio\System\Validator\Interfaces\Chain as ValidatorChainInterface;

/**
 * Interface Field
 *
 * @package Ampio\System\Form\Interfaces
 */
interface Field extends Validation
{
    // Names of constructor parameters for creating an object through the factory
    public const NAME             = 'name';
    public const FILTER_CHAIN     = 'filterChain';
    public const VALIDATOR_CHAIN  = 'validatorChain';
    public const BREAK_ON_FAILURE = 'breakOnFailure';
    public const DEFAULT_VALUE    = 'defaultValue';

    // Constructor parameter defaults
    public const WITHOUT_FILTER_CHAIN     = null;
    public const WITHOUT_VALIDATOR_CHAIN  = null;
    public const WITH_BREAK_ON_FAILURE    = true;
    public const WITHOUT_BREAK_ON_FAILURE = false;

    /**
     * Field constructor.
     *
     * When using the data array for verification, you must use the html syntax for the input name, for example,
     * user[firstname] or user[lastname], or use the dot as a separator - user.firstname or user.lastname
     *
     * @param string                                        $name html form input name
     * @param \Ampio\System\Filter\Interfaces\Chain|null    $filterChain
     * @param \Ampio\System\Validator\Interfaces\Chain|null $validatorChain
     * @param bool                                          $breakOnFailure
     * @param null|mixed                                    $defaultValue
     */
    public function __construct(
        string $name,
        ?FilterChainInterface $filterChain = self::WITHOUT_FILTER_CHAIN,
        ?ValidatorChainInterface $validatorChain = self::WITHOUT_VALIDATOR_CHAIN,
        bool $breakOnFailure = self::WITHOUT_BREAK_ON_FAILURE,
        $defaultValue = null
    );

    /**
     * Returns the name of the html form input
     *
     * @return string
     * @api
     */
    public function getName(): string;

    /**
     * Setting a value for filtering and validation
     *
     * This method MUST be implemented in such a way as to preserve the immutability of the field and must return an
     * instance that has a verifiable value.
     *
     * @param mixed $value
     *
     * @return $this new instance
     * @api
     */
    public function withValue($value): self;

    /**
     * Returns the filtered checked field value
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Returns the default value of the checked field
     *
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * Returns the original value of the checked field
     *
     * @return mixed
     */
    public function getRawValue();

    /**
     * @return bool
     */
    public function isBreakOnFailure(): bool;

    /**
     * Creates an instance of the Field::class from the provided specification
     *
     * @param string|iterable|\Ampio\System\Form\Interfaces\FieldProvider $specification
     * @param \Ampio\System\Filter\Interfaces\Chain                       $filterChain
     * @param \Ampio\System\Validator\Interfaces\Chain                    $validatorChain
     *
     * @return static
     * @internal
     */
    public static function make(
        $specification,
        FilterChainInterface $filterChain,
        ValidatorChainInterface $validatorChain
    ): self;
}
