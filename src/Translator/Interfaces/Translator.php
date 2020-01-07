<?php

/**
 * Date: 27.11.2019
 * Time: 15:12
 */
declare(strict_types=1);

namespace Ampio\System\Translator\Interfaces;

/**
 * Interface Translator
 *
 * @package Ampio\System\Translator\Interfaces
 */
interface Translator
{
    // Names parameters for creating an object through the factory
    public const OPT_LOCALE            = 'locale';
    public const OPT_BASE_DIR          = 'baseDir';
    public const OPT_DOMAIN            = 'domain';
    public const OPT_MESSAGE_FORMATTER = 'messageFormatter';
    public const OPT_CACHE             = 'cache';
    public const OPT_TTL               = 'ttl';
    public const OPT_FALLBACK_LOCALES  = 'fallbackLocales';
    
    /**
     * Lookup a message in the current domain
     *
     * @param string      $message The message being translated or the singular message ID.
     * @param string|null $domain  Domain to override for the current message only
     *
     * @return string Returns a translated string if one is found in the translation table, or the submitted message if
     *                not found.
     * @throws \RuntimeException
     * @api
     */
    public function gettext(string $message, string $domain = null): string;
    
    /**
     * Plural version of translate
     *
     * @param string      $message The message
     * @param string      $plural  The plural message
     * @param int         $number  The number (e.g. item count) to determine the translation for the respective
     *                             grammatical number.
     * @param string|null $domain  Domain to override for the current message only
     *
     * @return string Returns correct plural form of message identified by $message and $plural for count $number.
     * @throws \RuntimeException
     * @api
     */
    public function ngettext(string $message, string $plural, int $number, string $domain = null): string;
    
    /**
     * Search for a message in the current domain using ICU MessageFormat syntax
     *
     * @see http://userguide.icu-project.org/formatparse/messages
     *
     * @param string      $message    The message being translated
     * @param iterable    $parameters An array of parameters for the message
     * @param string|null $domain     Domain to override for the current message only
     *
     * @return string The translated string
     * @api
     */
    public function messageFormat(string $message, iterable $parameters = [], string $domain = null): string;
}
