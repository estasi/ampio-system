<?php

/**
 * Date: 06.12.2019
 * Time: 23:11
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

/**
 * Class Times
 *
 * @package Ampio\System\Utility
 */
abstract class TimePeriod
{
    public const ONE_SECOND      = 1;
    public const ONE_MINUTE      = 60;
    public const FIVE_MINUTES    = self::ONE_MINUTE * 5;
    public const TEN_MINUTES     = self::ONE_MINUTE * 10;
    public const FIFTEEN_MINUTES = self::ONE_MINUTE * 15;
    public const THIRTY_MINUTES  = self::ONE_MINUTE * 30;
    public const HALF_HOUR       = self::THIRTY_MINUTES;
    public const ONE_HOUR        = self::ONE_MINUTE * 60;
    public const TWELVE_HOURS    = self::ONE_HOUR * 12;
    public const ONE_DAY         = self::ONE_HOUR * 24;
    public const SEVEN_DAYS      = self::ONE_DAY * 7;
    public const ONE_WEEK        = self::SEVEN_DAYS;
    public const THIRTY_DAYS     = self::ONE_DAY * 30;
}
