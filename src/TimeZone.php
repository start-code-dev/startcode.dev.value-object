<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Constants\Timezones;
use Startcode\ValueObject\Exception\InvalidTimezoneException;

class TimeZone
{

    private string $value;

    /**
     * @throws InvalidTimezoneException
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function getZone() : string
    {
        preg_match_all("/\((.*?)\)/", $this->getAllZones()[$this->value], $matches);
        return $matches[1][1];
    }

    public function getGMTOffset() : string
    {
        preg_match_all("/\((.*?)\)/", $this->getAllZones()[$this->value], $matches);
        return $matches[1][0];
    }

    private function getAllZones() : array
    {
        return Timezones::ZONES;
    }


}


