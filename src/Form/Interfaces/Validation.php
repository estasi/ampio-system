<?php

/**
 * Date: 30.11.2019
 * Time: 23:13
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

use Ampio\System\Messages\Interfaces\Errors;

/**
 * Interface Validation
 *
 * @package Ampio\System\Form\Interfaces
 */
interface Validation extends Errors
{
    /**
     * Returns TRUE if value meets the validation requirements,
     * if value does not pass validation, this method returns FALSE.
     *
     * @return bool
     * @api
     */
    public function isValid(): bool;

    /**
     * Returns TRUE if value does not meet validation requirements,
     * if value passes validation, this method returns FALSE.
     *
     * @return bool
     * @api
     */
    public function notValid(): bool;

    /**
     * Returns TRUE if value meets the validation requirements,
     * if value does not pass validation, this method returns FALSE.
     *
     * synonym isValid()
     *
     * @return bool
     * @api
     */
    public function __invoke(): bool;
}
