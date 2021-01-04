<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Interfaces\StringInterface;
use Startcode\ValueObject\Exception\{InvalidLatitudeException, InvalidLongitudeException};

class Coordinate implements StringInterface
{
    public const LATITUDE_MIN_VALUE  = -90;
    public const LATITUDE_MAX_VALUE  =  90;
    public const LONGITUDE_MIN_VALUE = -180;
    public const LONGITUDE_MAX_VALUE =  180;

    private float $latitude;

    private float $longitude;

    /**
     * @throws InvalidLatitudeException
     * @throws InvalidLongitudeException
     */
    public function __construct(float $latitude, float $longitude)
    {
        if (!$this->isValidLatitude($latitude)) {
            throw new InvalidLatitudeException($latitude);
        }

        if (!$this->isValidLongitude($longitude)) {
            throw new InvalidLongitudeException($longitude);
        }

        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    public function __toString() : string
    {
        return implode(',', [$this->latitude, $this->longitude]);
    }

    public function getLatitude() : float
    {
        return $this->latitude;
    }

    public function getLongitude() : float
    {
        return $this->longitude;
    }

    /**
     * @throws InvalidLatitudeException
     * @throws InvalidLongitudeException
     */
    public function round(int $numberOfDecimals = 2) : self
    {
        $latitude  = round($this->latitude, $numberOfDecimals);
        $longitude = round($this->longitude, $numberOfDecimals);
        return new Coordinate($latitude, $longitude);
    }

    public function isValidLatitude(float $latitude) : bool
    {
        return $latitude >= self::LATITUDE_MIN_VALUE && $latitude <= self::LATITUDE_MAX_VALUE;
    }

    public function isValidLongitude(float $longitude) : bool
    {
        return $longitude >= self::LONGITUDE_MIN_VALUE && $longitude <= self::LONGITUDE_MAX_VALUE;
    }
}
