<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidIpException;
use Startcode\ValueObject\Interfaces\StringInterface;

class Ip implements StringInterface
{

    private string $value;

    /**
     * @throws InvalidIpException
     */
    public function __construct(string $value)
    {
        $valuesList = explode(',', trim($value));
        $value = (string)$valuesList[0];

        if (!$this->isValid($value)) {
            throw new InvalidIpException($value);
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP);
    }
}
