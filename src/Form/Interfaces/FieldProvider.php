<?php

/**
 * Date: 02.12.2019
 * Time: 14:50
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

/**
 * Interface FieldProvider
 *
 * @package Ampio\System\Form\Interfaces
 */
interface FieldProvider
{
    /**
     * Returns an array of data to create a form field
     *
     * @return array
     * @example array('name' => string 'nameField'[, 'breakOnFailure' => bool TRUE|FALSE][, 'defaultValue' => mixed][,
     *          'filterChain' => array(...)][, 'validatorChain' => array(...)])
     * @internal
     */
    public function getFieldProvider(): array;
}
