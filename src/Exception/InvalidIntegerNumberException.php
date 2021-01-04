<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidIntegerNumberException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_INTEGER_NUMBER_MESSAGE, $value), ErrorCodes::INVALID_INTEGER_NUMBER);
    }
}
