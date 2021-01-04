<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidUuidException;
use Startcode\ValueObject\Interfaces\StringInterface;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements StringInterface
{

    private string $value;

    /**
     * @throws InvalidUuidException
     */
    public function __construct(string $value)
    {
        if (! RamseyUuid::isValid($value)) {
            throw new InvalidUuidException($value);
        }

        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public static function generate() : self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}
