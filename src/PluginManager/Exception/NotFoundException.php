<?php

/**
 * Date: 27.11.2019
 * Time: 15:06
 */
declare(strict_types=1);

namespace Ampio\System\PluginManager\Exception;

use InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 *
 * @package Ampio\System\PluginManager\Exception
 */
class NotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{

}
