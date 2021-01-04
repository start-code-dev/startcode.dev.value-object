<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidStringLiteralException;
use Startcode\ValueObject\Interfaces\StringInterface;

class StringLiteral implements StringInterface
{

    private string $value;

    /**
     * @throws \Exception
     */
    public function __construct($value)
    {
        if (!\is_string($value)) {
            throw new InvalidStringLiteralException($value);
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function append(StringInterface $value, StringInterface $delimiter = null): self
    {
        $modified = $this->value . ($delimiter === null ? '' : (string) $delimiter) . $value;
        return new StringLiteral($modified);
    }

    public function equals(StringLiteral $value): bool
    {
        return $this->value === $value->__toString();
    }

    public function isEmpty(): bool
    {
        return strlen($this->value) === 0;
    }

    public function prepend(StringLiteral $value, StringInterface $delimiter = null): self
    {
        $modified = $value->__toString() . ($delimiter === null ? '' : $delimiter->__toString()) . $this->value;
        return new StringLiteral($modified);
    }
}
