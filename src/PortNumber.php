<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{InvalidIntegerNumberException, InvalidPortNumberException};

class PortNumber extends IntegerNumber
{
    /**
     * @throws InvalidPortNumberException
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        parent::__construct($value);

        if ($value < 1 || $value > 65535) {
            throw new InvalidPortNumberException($value);
        }

        $this->value = $value;
    }
}
