<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidLocationException;

class Location
{

    private string $value;

    /**
     * @throws InvalidLocationException
     */
    public function __construct(string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_URL) &&
            ! preg_match('/^[\w\/]/', $value)) {
            throw new InvalidLocationException($value);
        }
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function addQuery(array $values) : string
    {
        return $this->value . '?' . http_build_query($values);
    }
}
