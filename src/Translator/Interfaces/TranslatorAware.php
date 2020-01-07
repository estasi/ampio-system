<?php

/**
 * Date: 27.11.2019
 * Time: 15:13
 */
declare(strict_types=1);

namespace Ampio\System\Translator\Interfaces;

/**
 * Interface TranslatorAware
 *
 * @package Ampio\System\Translator\Interfaces
 */
interface TranslatorAware
{
    /**
     * Set Translator
     *
     * @param \Ampio\System\Translator\Interfaces\Translator $translator
     *
     * @return $this
     * @api
     */
    public function setTranslator(Translator $translator): self;
    
    /**
     * Return a Translator object
     *
     * @return \Ampio\System\Translator\Interfaces\Translator
     * @throws \LogicException Error accessing the Translator object - should not be available before
     *                         initialization.
     */
    public function getTranslator(): Translator;
    
    /**
     * Returns true if you can return a Translator object
     * Returns false otherwise.
     *
     * @return bool
     */
    public function hasTranslator(): bool;
    
    /**
     * Returns the current domain to search for messages
     *
     * @return string
     * @api
     */
    public function getDomain(): string;
}
