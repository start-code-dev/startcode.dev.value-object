<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidPhoneNumberException;

class PhoneNumber
{

    private string $value;

    /**
     * @throws InvalidPhoneNumberException
     */
    public function __construct(string $value)
    {
        $sanitized = (string)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        if (!$this->isValid($sanitized)) {
            throw new InvalidPhoneNumberException($value);
        }
        $this->value = $sanitized;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    private function isValid(string $value) : bool
    {
        return preg_match('/\(?(\d{3})\)?([-]?)(\d{2,4})\2(\d{3,4})/', $value);
    }

}
