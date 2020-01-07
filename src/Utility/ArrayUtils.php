<?php

/**
 * Date: 25.11.2019
 * Time: 12:32
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

use Generator;
use Traversable;

/**
 * Class ArrayUtils
 *
 * @package Ampio\System\Utility
 */
abstract class ArrayUtils
{
    /**
     * Searches the array for the value of the specified key
     *
     * @param string   $key  Search value
     * @param iterable $data An array or \Traversable of search
     *
     * @return mixed
     */
    public static function find(string $key, iterable $data)
    {
        $result = null;
        
        $data = self::iteratorToArray($data);
        if (self::emptyKeyOrData($key, $data)) {
            goto _return_;
        }
        /**
         * @param string $keys
         * @param array  $data
         *
         * @return array|mixed|null
         */
        $getResult = function (string $keys, array $data) {
            $result = null;
            foreach (explode('.', $keys) as $key) {
                if (array_key_exists($key, $data)) {
                    $data = $data[$key];
                } else {
                    goto _return_;
                }
            }
            $result = $data;
            
            _return_:
            
            return $result;
        };
        // search .* in $needle
        if (preg_match('`(.+)\x2e\x2a$`', $key, $match)) {
            if (null === $result = $getResult($match[1], $data)) {
                $keys   = preg_grep(sprintf('`^%s`', $match[1]), array_keys($data));
                $result = array_intersect_key($data, array_flip($keys));
            }
        } else {
            $result = $data[$key] ?? $getResult($key, $data);
        }
        
        _return_:
        
        return $result;
    }
    
    /**
     * Returns an array with only the specified keys
     *
     * @param string|iterable $keys Required array keys. If a string is given, then the necessary keys should be
     *                              separated by "|" first keys ":" keys plug first
     * @param iterable        $data The data in which the search is performed
     *
     * @return array
     */
    public static function withSpecifiedKeysOnly($keys, iterable $data): array
    {
        self::checkKeys($keys);
        $result = $data = self::iteratorToArray($data);
        if (false === self::emptyKeyOrData($keys, $data)) {
            $result = self::intersectKeys($keys, $data, false);
        }
        
        return $result;
    }
    
    /**
     * Returns an array without the specified keys
     *
     * @param string|iterable $keys
     * @param iterable        $data
     *
     * @return array
     */
    public static function withoutSpecifiedKeys($keys, iterable $data): array
    {
        self::checkKeys($keys);
        $result = $data = self::iteratorToArray($data);
        if (false === self::emptyKeyOrData($keys, $data)) {
            $result = self::intersectKeys($keys, $data, true);
        }
        
        return $result;
    }
    
    /**
     * Converting a multidimensional array to a one-dimensional array
     *
     * @param iterable $data
     *
     * @return array
     */
    public static function multiToOneDim(iterable $data): array
    {
        /**
         * @param iterable $data
         * @param null     $key
         *
         * @return \Generator
         */
        $process = function (iterable $data, $key = null) use (&$process): Generator {
            $key .= isset($key) ? '.' : '';
            foreach ($data as $index => $value) {
                if (is_iterable($value)) {
                    yield from $process($value, $key . $index);
                } else {
                    yield $key . $index => $value;
                }
            }
        };
        
        $result = [];
        foreach ($process($data) as $key => $value) {
            $result[$key] = $value;
        }
        
        return $result;
    }
    
    /**
     * Converting a one-dimensional array to a multidimensional array
     *
     * @param iterable $data
     *
     * @return array
     */
    public static function oneToMultiDim(iterable $data): array
    {
        /**
         * @param array $result
         * @param array $keys
         * @param mixed $value
         */
        $process = function (array &$result, array $keys, $value) use (&$process): void {
            static $i = 0;
            $key = array_shift($keys);
            if (false === isset($key)) {
                $key = $i++;
            }
            if (empty($keys)) {
                $result[$key] = $value;
            } else {
                if (false === array_key_exists($key, $result)) {
                    $result[$key] = [];
                }
                $process($result[$key], $keys, $value);
            }
        };
        
        $result = [];
        foreach ($data as $key => $value) {
            $process($result, explode('.', $key), $value);
        }
        
        return $result;
    }
    
    
    /**
     * Checks if the given key or index exists in the array
     *
     * @param string   $key
     * @param iterable $data
     *
     * @return bool
     */
    public static function keyExists(string $key, iterable $data): bool
    {
        $result = false;
        $data   = self::iteratorToArray($data);
        if (self::emptyKeyOrData($key, $data)) {
            goto _return_;
        }
        /**
         * @param string $needle
         * @param array  $data
         *
         * @return bool
         */
        $checkKeyExists = function (string $needle, array $data): bool {
            $result = false;
            foreach (explode('.', $needle) as $key) {
                if ($result = array_key_exists($key, $data)) {
                    $data = $data[$key];
                } else {
                    break;
                }
            }
            
            return $result;
        };
        // search .* in $needle
        if (preg_match('`(.+)\x2e\x2a$`', $key, $match)) {
            if (false === $result = $checkKeyExists($match[1], $data)) {
                $keys   = preg_grep(sprintf('`^%s`', $match[1]), array_keys($data));
                $result = boolval($keys);
            }
        } else {
            $result = array_key_exists($key, $data) ? true : $checkKeyExists($key, $data);
        }
        
        _return_:
        
        return $result;
    }
    
    /**
     * @param string $key
     *
     * @return string
     */
    public static function keyDotToBracketsSeparator(string $key): string
    {
        return preg_replace('`\x2e([^\x2e]+)`', '[$1]', $key);
    }
    
    /**
     * @param string $key
     *
     * @return string
     */
    public static function keyBracketsToDotSeparator(string $key): string
    {
        return preg_replace_callback(
            '`\x5B([\d\p{L}\x2D\x5F]*)\x5D`',
            function (array $match): string {
                if (ctype_digit($match[1])) {
                    $match[1] = (int)$match[1];
                } elseif (empty($match[1])) {
                    $match[1] = '*';
                }
                
                return '.' . $match[1];
            },
            $key
        );
    }

    /**
     * If the pseudotype variable iterable is an object that implements Traversable, the function copies the iterator
     * to an array
     *
     * @param iterable $data
     * @param bool     $useKeys Whether to use the iterator element keys as index.
     *
     * @return array
     */
    public static function iteratorToArray(iterable $data, bool $useKeys = true): array
    {
        if ($data instanceof Traversable) {
            $data = iterator_to_array($data, $useKeys);
        }

        return $data;
    }

    /**
     * @param string|array $keys
     * @param iterable     $data
     * @param bool         $invertGrep specifies whether to issue an array with or without the specified keys
     *
     * @return array
     */
    protected static function intersectKeys($keys, iterable $data, bool $invertGrep = false): array
    {
        $result    = $data = self::iteratorToArray($data);
        $keysArray = [];
        switch (gettype($keys)) {
            case Variable::STRING:
                // splits the query string type "key1.subkey1_1|key2" on the array [key1.subkey1_1, key2]
                foreach (explode('|', $keys) as $item) {
                    // splits the query string type "key1.subkey1_1:subkey1_3:subkey1_6"
                    // on the array [key1.subkey1_1, key1.subkey1_3, key1.subkey1_6]
                    if (strpos($item, ':')) {
                        $items       = explode(':', $item);
                        $firstItem   = array_shift($items);
                        $keysArray[] = $firstItem;
                        $firstItem   = substr($firstItem, 0, strrpos($firstItem, '.'));
                        foreach ($items as $subItem) {
                            $keysArray[] = $firstItem . '.' . $subItem;
                        }
                    } else {
                        $keysArray[] = $item;
                    }
                }
                break;
            case Variable::ARRAY:
                $keysArray = $keys;
                break;
            default:
                goto _return_;
        }
        // convert a multidimensional array to a one-dimensional array for easy search
        $arrayOneDim     = self::multiToOneDim($data);
        $arrayOneDimKeys = array_keys($arrayOneDim);
        // get the array of keys needed to get the result
        $tmpArray = [];
        foreach ($keysArray as $k => $key) {
            $tmpArray = array_merge($tmpArray, preg_grep(sprintf('`^%s.*$`', preg_quote($key)), $arrayOneDimKeys));
        }
        print_r($tmpArray);
        // converting a one-dimensional array to a multidimensional array to produce a result
        $arrayFlip = array_flip($tmpArray);
        $result    = self::oneToMultiDim(
            $invertGrep ? array_diff_key($arrayOneDim, $arrayFlip) : array_intersect_key($arrayOneDim, $arrayFlip)
        );
        _return_:

        return $result;
    }

    /**
     * @param string|array $key
     * @param iterable     $data
     *
     * @return bool
     */
    protected static function emptyKeyOrData($key, iterable $data): bool
    {
        return empty($key) || empty($data);
    }

    /**
     * @param $keys
     */
    private static function checkKeys(&$keys): void
    {
        if (is_iterable($keys)) {
            $keys = self::iteratorToArray($keys);
        } elseif (false === is_string($keys)) {
            $keys = '';
        }
    }
}
