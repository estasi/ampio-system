<?php

/**
 * Date: 27.11.2019
 * Time: 15:37
 */
declare(strict_types=1);

namespace Ampio\System\Filter\Interfaces;

/**
 * Interface Filtration
 *
 * @package Ampio\System\Filter\Interfaces
 */
interface Filtration
{
    /**
     * Filters a variable with a specified filter
     *
     * @param mixed $value
     *
     * @return mixed
     * @api
     */
    public function filter($value);

    /**
     * Filters a variable with a specified filter
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function __invoke($value);
}
