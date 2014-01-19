<?php
/**
 * @author     Tyurin D. <fobia3d@gmail.com>
 * @copyright  Copyright (c) 2013 AC Software
 */


/**
 * DateTime with serialization and timestamp support for PHP 5.2.
 *
 * @author     David Grudl
 */
class CDateTime extends \DateTime
{

    /** minute in seconds */
    const MINUTE = 60;

    /** hour in seconds */
    const HOUR = 3600;

    /** day in seconds */
    const DAY = 86400;

    /** week in seconds */
    const WEEK = 604800;

    /** average month in seconds */
    const MONTH = 2629800;

    /** average year in seconds */
    const YEAR = 31557600;

    /**
     * DateTime object factory.
     * @param  string|int|\DateTime
     * @return DateTime
     */
    public static function from($time)
    {
        if ($time instanceof \DateTime) {
            return new self($time->format('Y-m-d H:i:s'), $time->getTimezone());
        } elseif (is_numeric($time)) {
            if ($time <= self::YEAR) {
                $time += time();
            }
            return new static(date('Y-m-d H:i:s', $time));
        } else { // textual or NULL
            return new static($time);
        }
    }

    public function __toString()
    {
        return $this->format('Y-m-d H:i:s');
    }

    public function modifyClone($modify = '')
    {
        $dolly = clone $this;
        return $modify ? $dolly->modify($modify) : $dolly;
    }
}