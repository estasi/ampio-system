<?php

/**
 * Date: 27.11.2019
 * Time: 15:16
 */
declare(strict_types=1);

namespace Ampio\System\Validator\Interfaces;

use Countable;

/**
 * Interface Chain
 *
 * @package Ampio\System\Validator\Interfaces
 */
interface Chain extends Validation, Countable
{
    public const DEFAULT_PLUGIN_MANAGER = null;

    // Names of attach and prepend parameters for creating an object through the factory
    public const VALIDATOR_NAME             = 'validator';
    public const VALIDATOR_OPTIONS          = 'options';
    public const VALIDATOR_BREAK_ON_FAILURE = 'breakOnFailure';
    public const VALIDATOR_PRIORITY         = 'priority';

    /**
     * Chain constructor.
     *
     * @param \Ampio\System\Validator\Interfaces\PluginManager|null     $pluginManager
     * @param string|array|\Ampio\System\Validator\Interfaces\Validator ...$validators
     */
    public function __construct(?PluginManager $pluginManager = self::DEFAULT_PLUGIN_MANAGER, ...$validators);

    /**
     * Attaches the validator to the queue
     *
     * If $breakChainOnFailure is true, then if the validator fails, the next validator in the chain, if one exists,
     * will not be executed.
     *
     * This method MUST be implemented in a way that preserves the chain immutability, and must return an instance that
     * has a modified call chain
     *
     * @param string|array|\Ampio\System\Validator\Interfaces\Validator $validator      takes as a parameter a string
     *                                                                                  (the name of the Validator
     *                                                                                  class), a Validator object, or
     *                                                                                  an array of keys (validator,
     *                                                                                  options, message_template)
     * @param bool                                                      $breakOnFailure interrupting chain execution
     *                                                                                  when receiving FALSE from
     *                                                                                  validator
     * @param int                                                       $priority       Priority at which to enqueue
     *                                                                                  validator; defaults to 1
     *                                                                                  (higher
     *                                                                                  executes earlier)
     *
     * @return $this
     * @api
     */
    public function attach($validator, bool $breakOnFailure = false, int $priority = 1): self;

    /**
     * Attaches the validator to the top of the queue
     *
     * If $breakChainOnFailure is true, then if the validator fails, the next validator in the chain, if one exists,
     * will not be executed.
     *
     * This method MUST be implemented in a way that preserves the chain immutability, and must return an instance that
     * has a modified call chain
     *
     * @param string|array|\Ampio\System\Validator\Interfaces\Validator $validator      takes as a parameter a string
     *                                                                                  (the name of the Validator
     *                                                                                  class), a Validator object, or
     *                                                                                  an array of keys (validator,
     *                                                                                  options, message_template)
     * @param bool                                                      $breakOnFailure interrupting chain execution
     *                                                                                  when receiving FALSE from
     *                                                                                  validator
     *
     * @return $this
     * @api
     */
    public function prepend($validator, bool $breakOnFailure = false): self;

    /**
     * Attaches the entire chain at once. Analogous to the entry in the class constructor.
     *
     * ATTENTION!!! When writing, the chain created in the constructor MUST be cleared.
     *
     * @param iterable $validators
     *
     * @internal
     */
    public function putAll(iterable $validators): void;

    /**
     * Returns the validator queue
     *
     * @return iterable
     */
    public function getValidators(): iterable;
}
