<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{InvalidEmailException, MissingEmailValueException};

class Email
{

    private string $value;

    /**
     * @throws MissingEmailValueException
     * @throws InvalidEmailException
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new MissingEmailValueException($value);
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($value);
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Email $value): bool
    {
        return $this->value === $value->__toString();
    }

    public function getWithoutPlusAlias(): string
    {
        $this->value = preg_replace("/\+\S+(?=@\w+)/", '', $this->value);
        return $this->value;
    }
}
