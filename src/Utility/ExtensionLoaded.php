<?php

/**
 * Date: 07.12.2019
 * Time: 23:54
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

use RuntimeException;

/**
 * Class ExtensionLoaded
 *
 * @package Ampio\System\Utility
 */
abstract class ExtensionLoaded
{
    /**
     * @param string $ext
     *
     * @throws \RuntimeException
     */
    public static function check(string $ext): void
    {
        if (false === extension_loaded($ext)) {
            throw new RuntimeException(sprintf('PHP extension "%s" not loaded!', $ext));
        }
    }
}
