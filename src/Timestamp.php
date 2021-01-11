<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidTimestampException;

class Timestamp
{

    public const SECONDS_IN_DAY = 86400;

    private int $value;

    /**
     * @throws InvalidTimestampException
     */
    public function __construct(int $value)
    {
        if (! self::isValid($value)) {
            throw new InvalidTimestampException($value);
        }
        $this->value = $value;
    }

    public function __toString() : string
    {
        return (string) $this->value;
    }

    public function getValue() : int
    {
        return $this->value;
    }

    public function addDays($days) : Timestamp
    {
        return new self($this->getValue() + self::SECONDS_IN_DAY * $days);
    }

    public function getFormattedForDB() : string
    {
        return date('Y-m-d G:i:s', $this->value);
    }

    public static function createFromString(string $dateTime) : Timestamp
    {
        return new self(strtotime($dateTime));
    }

    public static function generate(int $add = 0) : Timestamp
    {
        return new static(time() + $add);
    }

    public static function isValid(int $timestamp) : bool
    {
        return ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }

    public function get24HoursAgo() : Timestamp
    {
        $timeAgo = $this->value - self::SECONDS_IN_DAY;
        return new  Timestamp($timeAgo);
    }

    public function getFormatted() : string
    {
        return  date('h:iA', $this->value);
    }
}
