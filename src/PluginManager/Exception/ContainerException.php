<?php

/**
 * Date: 27.11.2019
 * Time: 15:03
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Exception;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

/**
 * Class ContainerException
 *
 * @package Ampio\System\PluginManager\Exception
 */
class ContainerException extends RuntimeException implements ContainerExceptionInterface
{
    
}
