<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidStringLiteralException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_STRING_LITERAL_MESSAGE, $value), ErrorCodes::INVALID_STRING_LITERAL);
    }
}
