<?php

/**
 * Date: 27.11.2019
 * Time: 15:28
 */
declare(strict_types=1);

namespace Ampio\System\Utility\Traits;

/**
 * Trait TopPriority
 *
 * @package Ampio\System\Utility\Traits
 */
trait TopPriority
{
    /** @var int */
    private int $topPriority = 1;
    
    /**
     * @return int
     */
    public function getTopPriority(): int
    {
        return $this->topPriority;
    }
    
    /**
     * @param int $priority
     */
    protected function setTopPriority(int $priority): void
    {
        if ($priority >= $this->topPriority) {
            $this->topPriority = $priority + 1;
        }
    }
}
