<?php

/**
 * Date: 30.11.2019
 * Time: 23:42
 */
declare(strict_types=1);

namespace Ampio\System\Form\Interfaces;

/**
 * Interface FormAware
 *
 * @package Ampio\System\Form\Interfaces
 */
interface FormAware
{
    /**
     * @return \Ampio\System\Form\Interfaces\Form
     */
    public function getForm(): Form;
}
