<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidIntegerNumberException;
use Startcode\ValueObject\Interfaces\NumberInterface;

class IntegerNumber implements NumberInterface
{
    /*
     * @var integer
     */
    private $value;

    /**
     * IntegerNumber constructor.
     * @param $value
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        if ($value === true || \filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidIntegerNumberException($value);
        }
        $this->value = \intval($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    /**
     * @param IntegerNumber $value
     * @return bool
     */
    public function equals(IntegerNumber $value): bool
    {
        return $this->value === $value->getValue();
    }

    /*
     * @return integer
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isZeroValue(): bool
    {
        return $this->value === 0;
    }
}
