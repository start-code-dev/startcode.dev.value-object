<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidBirthdayException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_BIRTHDAY_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_BIRTHDAY_CODE
        );
    }
}
