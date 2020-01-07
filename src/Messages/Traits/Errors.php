<?php

/**
 * Date: 23.11.2019
 * Time: 23:31
 */
declare(strict_types=1);

namespace Ampio\System\Messages\Traits;

use Ampio\System\Utility\ArrayUtils;

/**
 * Trait Errors
 *
 * @package Ampio\System\Messages\Traits
 */
trait Errors
{
    /** @var array */
    private array $errors = [];

    /**
     * @inheritDoc
     */
    public function isLastError(string $errorCode): bool
    {
        // TODO: Implement isLastError() method.
        return 0 === strcmp($errorCode, $this->getLastErrorCode());
    }

    /**
     * @inheritDoc
     */
    public function getLastErrorCode(): ?string
    {
        // TODO: Implement getLastErrorCode() method.
        return array_key_last($this->errors);
    }

    /**
     * @inheritDoc
     */
    public function getLastErrorMessage(): ?string
    {
        // TODO: Implement getLastErrorMessage() method.
        $lastErrorMessage = end($this->errors);

        return $lastErrorMessage ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getLastErrors(): iterable
    {
        // TODO: Implement getLastErrors() method.
        return array_unique($this->errors);
    }

    /**
     * @inheritDoc
     */
    public function getLastError(): iterable
    {
        // TODO: Implement getLastError() method.
        return array_slice($this->errors, -1);
    }

    protected function setError(string $code, string $message): void
    {
        $this->errors[$code] = $message;
    }

    /**
     * Initializes an array of error messages.
     *
     * Attention!!! If the array of error messages already contained the values, then it is overwritten.
     * To complement the array, use mergeErrors()
     *
     * @param iterable $errors
     */
    protected function setErrors(iterable $errors): void
    {
        $this->errors = ArrayUtils::iteratorToArray($errors);
    }

    protected function mergeErrors(iterable $errors): void
    {
        $this->errors = array_merge($this->errors, ArrayUtils::iteratorToArray($errors));
    }
}
