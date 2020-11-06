<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidStringLiteralException;
use Startcode\ValueObject\Interfaces\StringInterface;

class StringLiteral implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * StringLiteral constructor.
     * @param $value string
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

    /**
     * @param StringInterface $value
     * @param StringInterface|null $delimiter
     * @return StringLiteral
     */
    public function append(StringInterface $value, StringInterface $delimiter = null): self
    {
        $modified = $this->value . ($delimiter === null ? '' : $delimiter->__toString()) . $value->__toString();
        return new StringLiteral($modified);
    }

    /**
     * @param StringLiteral $value
     * @return bool
     */
    public function equals(StringLiteral $value): bool
    {
        return $this->value === $value->__toString();
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return strlen($this->value) === 0;
    }

    /**
     * @param StringLiteral $value
     * @param StringInterface|null $delimiter
     * @return StringLiteral
     */
    public function prepend(StringLiteral $value, StringInterface $delimiter = null): self
    {
        $modified = $value->__toString() . ($delimiter === null ? '' : $delimiter->__toString()) . $this->value;
        return new StringLiteral($modified);
    }
}
