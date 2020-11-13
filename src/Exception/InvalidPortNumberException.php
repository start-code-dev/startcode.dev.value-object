<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class InvalidPortNumberException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_PORT_MESSAGE, $value), ErrorCodes::INVALID_PORT_NUMBER);
    }
}
