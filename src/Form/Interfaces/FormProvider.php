<?php

/**
 * Date: 02.12.2019
 * Time: 11:34
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

/**
 * Interface FormProvider
 *
 * @package Ampio\System\Form\Interfaces
 */
interface FormProvider
{
    /**
     * Returns an array of data for creating form fields
     *
     * @return array
     * @example array(
     *      array('name' => string 'nameField'[, 'breakOnFailure' => bool TRUE|FALSE][, 'defaultValue' => mixed][,
     *          'filterChain' => array(...)][, 'validatorChain' => array(...)]),
     *      array('name' => string 'nameField'[, 'breakOnFailure' => bool TRUE|FALSE][, 'defaultValue' => mixed][,
     *          'filterChain' => array(...)][, 'validatorChain' => array(...)]),
     *      ...
     * )
     * @internal
     */
    public function getFormSpecification(): array;
}
