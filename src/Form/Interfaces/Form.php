<?php

/**
 * Date: 30.11.2019
 * Time: 23:39
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

use Countable;
use Ampio\System\Filter\Interfaces\Chain as FilterChainInterface;
use Ampio\System\Validator\Interfaces\Chain as ValidatorChainInterface;

/**
 * Interface Form
 *
 * @package Ampio\System\Form\Interfaces
 */
interface Form extends Validation, Countable
{
    // The default values of the self::make() method parameters
    public const DEFAULT_FILTER_CHAIN    = null;
    public const DEFAULT_VALIDATOR_CHAIN = null;

    /**
     * Form constructor.
     *
     * @param \Ampio\System\Form\Interfaces\Field ...$fields
     */
    public function __construct(Field ...$fields);

    /**
     * Return an instance with the provided Field object.
     *
     * This method MUST be implemented in a way that preserves the form immutability and must return an instance that
     * has a modified set of fields.
     *
     * @param \Ampio\System\Form\Interfaces\Field $field
     *
     * @return static
     * @api
     */
    public function withField(Field $field): self;

    /**
     * Return an instance that removes the specified derived Field object.
     *
     * This method MUST be implemented in a way that preserves the form immutability and must return an instance that
     * has a modified set of fields.
     *
     * @param string $fieldName
     *
     * @return static
     * @api
     */
    public function withoutField(string $fieldName): self;

    /**
     * @param string $fieldName
     *
     * @return \Ampio\System\Form\Interfaces\Field
     * @api
     */
    public function getField(string $fieldName): Field;

    /**
     * @param string $fieldName
     *
     * @return bool
     * @api
     */
    public function hasField(string $fieldName): bool;

    /**
     * @return iterable
     * @api
     */
    public function getValidFields(): iterable;

    /**
     * @return iterable
     * @api
     */
    public function getInvalidFields(): iterable;

    /**
     * @param iterable $data
     *
     * @return static
     * @api
     */
    public function setData(iterable $data): self;

    /**
     * @return iterable
     */
    public function getFields(): iterable;

    /**
     * Attaches all form fields at once. Similar to writing in a class constructor.
     *
     * Attention!!! When writing, the fields created in the constructor MUST be cleared.
     *
     * @param \Ampio\System\Form\Interfaces\Field ...$fields
     *
     * @internal
     */
    public function putAll(Field ...$fields): void;

    /**
     * Creates an instance of the Form::class from the provided specification
     *
     * @param string|iterable|\Ampio\System\Form\Interfaces\FormProvider $specification
     * @param \Ampio\System\Filter\Interfaces\Chain|null                 $filterChain
     * @param \Ampio\System\Validator\Interfaces\Chain|null              $validatorChain
     *
     * @return static
     * @internal
     */
    public static function make(
        $specification,
        ?FilterChainInterface $filterChain = self::DEFAULT_FILTER_CHAIN,
        ?ValidatorChainInterface $validatorChain = self::DEFAULT_VALIDATOR_CHAIN
    ): self;
}
