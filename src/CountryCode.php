<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Constants\Countries;
use Startcode\ValueObject\Exception\InvalidCountryCodeException;

class CountryCode
{

    private string $value;

    /**
     * @throws InvalidCountryCodeException
     */
    public function __construct(string $value)
    {
        if (! $this->isValid($value)) {
            throw new InvalidCountryCodeException($value);
        }
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function getName() : string
    {
        return Countries::COUNTRY_CODES[$this->value];
    }

    private function isValid($value) : bool
    {
        return array_key_exists($value, Countries::COUNTRY_CODES);
    }
}
