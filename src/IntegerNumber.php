<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidIntegerNumberException;
use Startcode\ValueObject\Interfaces\NumberInterface;

class IntegerNumber implements NumberInterface
{
    private int $value;

    /**
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        if ($value === true || \filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidIntegerNumberException($value);
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function equals(IntegerNumber $value): bool
    {
        return $this->value === $value->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isZeroValue(): bool
    {
        return $this->value === 0;
    }
}
