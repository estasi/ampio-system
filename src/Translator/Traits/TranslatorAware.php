<?php

/**
 * Date: 27.11.2019
 * Time: 15:25
 */
declare(strict_types=1);

namespace Ampio\System\Translator\Traits;

use Ampio\System\Translator\Interfaces\Translator;
use LogicException;

/**
 * Trait TranslatorAware
 *
 * @package Ampio\System\Translator\Traits
 */
trait TranslatorAware
{
    /** @var \Ampio\System\Translator\Interfaces\Translator|null */
    private ?Translator $translator = null;
    
    /**
     * @inheritDoc
     */
    public function setTranslator(Translator $translator): self
    {
        $this->translator = $translator;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getTranslator(): Translator
    {
        if ($this->hasTranslator()) {
            return $this->translator;
        }
        
        throw new LogicException('The Translator is not defined in the class "' . static::class . '"!');
    }
    
    /**
     * @inheritDoc
     */
    public function hasTranslator(): bool
    {
        return boolval($this->translator);
    }
}
