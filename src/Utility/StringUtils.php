<?php

/**
 * Date: 25.11.2019
 * Time: 14:57
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

/**
 * Class StringUtils
 *
 * @package Ampio\System\Utility
 */
abstract class StringUtils
{
    /**
     * @param string $word
     * @param string $separator
     *
     * @return string
     */
    public static function camelCaseToSeparator(string $word, string $separator): string
    {
        return preg_match_all('`(?|^(\p{Lu}?\p{Ll}+)|(\p{Lu}\p{Ll}+))`u', $word, $matches)
            ? implode($separator, array_map('mb_strtolower', $matches[0]))
            : $word;
    }
    
    /**
     * @param string      $word
     * @param string|null $separator
     *
     * @return string
     */
    public static function separatorToCamelCase(string $word, ?string $separator = null): string
    {
        return preg_replace_callback(
            sprintf('`([%s]+)(\p{L}{1})`Su', self::convertSeparatorToASCII($separator)),
            fn(array $match): string => mb_strtoupper($match[2]),
            $word
        );
    }
    
    /**
     * @param string      $word
     * @param string      $newSeparator
     * @param string|null $oldSeparator
     *
     * @return string
     */
    public static function separatorToSeparator(string $word, string $newSeparator, ?string $oldSeparator = null): string
    {
        return preg_replace(
            sprintf('`[%s]`Su', self::convertSeparatorToASCII($oldSeparator)),
            $newSeparator,
            $word
        );
    }
    
    /**
     * @param string $word
     * @param string ...$prefixes
     *
     * @return array
     */
    public static function withPrefixesCamelName(string $word, string ...$prefixes): array
    {
        return self::withPrefixes(ucfirst($word), $prefixes);
    }
    
    /**
     * @param string $word
     * @param string $separator
     * @param string ...$prefixes
     *
     * @return array
     */
    public static function withPrefixesSeparator(string $word, string $separator, string ...$prefixes): array
    {
        return self::withPrefixes(($separator . $word), $prefixes);
    }
    
    /**
     * @param string $word
     * @param array  $prefixes
     *
     * @return array
     */
    private static function withPrefixes(string $word, array $prefixes): array
    {
        $result = [];
        foreach ($prefixes as $prefix) {
            $result[] = $prefix . $word;
        }
        
        return $result;
    }
    
    /**
     * Converts delimiter characters to hexadecimal characters \xhh for PCRE
     *
     * @param string|null $separator
     *
     * @return string
     */
    private static function convertSeparatorToASCII(?string $separator): string
    {
        if (boolval($separator)) {
            $symbols = str_split($separator);
            
            return vsprintf(str_repeat('\x%x', count($symbols)), array_map('ord', $symbols));
        }
        
        return '[:punct:]\s';
    }
}
