<?php

/**
 * Date: 27.11.2019
 * Time: 15:10
 */
declare(strict_types=1);

namespace Ampio\System\Validator\Interfaces;

use Ampio\System\Messages\Interfaces\Errors;

/**
 * Interface Validation
 *
 * @package Ampio\System\Validator\Interfaces
 */
interface Validation extends Errors
{
    /**
     * Returns TRUE if $value meets the validation requirements,
     * if $value does not pass validation, this method returns FALSE.
     *
     * @param mixed $value
     *
     * @return bool
     * @api
     */
    public function isValid($value): bool;
    
    /**
     * Returns TRUE if $value does not meet validation requirements,
     * if $value passes validation, this method returns FALSE.
     *
     * @param mixed $value
     *
     * @return bool
     * @api
     */
    public function notValid($value): bool;
    
    /**
     * Returns TRUE if $value meets the validation requirements,
     * if $value does not pass validation, this method returns FALSE.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function __invoke($value): bool;
}
