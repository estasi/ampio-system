<?php

/**
 * Date: 06.12.2019
 * Time: 23:22
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

/**
 * Class FopenMode
 *
 * @package Ampio\System\Utility
 */
abstract class FOpenMode
{
    public const R        = 'r';
    public const R_PLUS   = 'r+';
    public const W        = 'w';
    public const W_PLUS   = 'w+';
    public const A        = 'a';
    public const A_PLUS   = 'a+';
    public const X        = 'x';
    public const X_PLUS   = 'x+';
    public const C        = 'c';
    public const C_PLUS   = 'c+';
    public const R_B      = 'rb';
    public const R_PLUS_B = 'r+b';
    public const W_B      = 'wb';
    public const W_PLUS_B = 'w+b';
    public const A_B      = 'ab';
    public const A_PLUS_B = 'a+b';
    public const X_B      = 'xb';
    public const X_PLUS_B = 'x+b';
    public const C_B      = 'cb';
    public const C_PLUS_B = 'c+b';
    public const R_T      = 'rt';
    public const R_PLUS_T = 'r+t';
    public const W_T      = 'wt';
    public const W_PLUS_T = 'w+t';
    public const A_T      = 'at';
    public const A_PLUS_T = 'a+t';
    public const X_T      = 'xt';
    public const X_PLUS_T = 'x+t';
    public const C_T      = 'ct';
    public const C_PLUS_T = 'c+t';
}
