<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{InvalidMd5Exception, MissingMd5ValueException};

class Md5
{

    private string $value;

    /**
     * @throws MissingMd5ValueException
     * @throws InvalidMd5Exception
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new MissingMd5ValueException();
        }

        if (!preg_match('/^[a-fA-F0-9]{32}$/', $value)) {
            throw new InvalidMd5Exception($value);
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Md5 $value): bool
    {
        return $this->value === $value->__toString();
    }

    public static function calculateMd5(string $value): self
    {
        return new self(md5($value));
    }
}
