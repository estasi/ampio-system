<?php

/**
 * Date: 26.11.2019
 * Time: 8:56
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

use BadMethodCallException;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;

/**
 * Class Method
 *
 * @method static bool isGet(RequestInterface $request)
 * @method static bool isPost(RequestInterface $request)
 * @method static bool isConnect(RequestInterface $request)
 * @method static bool isDelete(RequestInterface $request)
 * @method static bool isHead(RequestInterface $request)
 * @method static bool isOptions(RequestInterface $request)
 * @method static bool isPatch(RequestInterface $request)
 * @method static bool isPut(RequestInterface $request)
 * @method static bool isTrace(RequestInterface $request)
 *
 * @package Ampio\System\Utility
 */
abstract class HttpMethod
{
    public const GET     = 'GET';
    public const POST    = 'POST';
    public const CONNECT = 'CONNECT';
    public const DELETE  = 'DELETE';
    public const HEAD    = 'HEAD';
    public const OPTIONS = 'OPTIONS';
    public const PATCH   = 'PATCH';
    public const PUT     = 'PUT';
    public const TRACE   = 'TRACE';
    public const METHODS = [
        self::GET,
        self::HEAD,
        self::POST,
        self::PATCH,
        self::PUT,
        self::DELETE,
        self::CONNECT,
        self::OPTIONS,
        self::TRACE,
    ];
    
    /**
     * @inheritDoc
     */
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        $method = strtoupper(substr($name, 2));
        if (false === in_array($method, self::METHODS)) {
            throw new BadMethodCallException(
                sprintf('The requested method "%s" is not supported by the class "%s"!', $name, self::class)
            );
        }
        /** @var RequestInterface $request */
        $request = $arguments[0];
        if (false === $request instanceof RequestInterface) {
            // Exception filed parameter
            throw new InvalidArgumentException(
                'The $request parameter is not an instance of the interface "Psr\Http\Message\RequestInterface"!'
            );
        }
        
        return 0 === strcmp($request->getMethod(), $method);
    }
}
