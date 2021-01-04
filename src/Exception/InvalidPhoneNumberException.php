<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidPhoneNumberException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_PHONE_NUMBER_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_PHONE_NUMBER_CODE
        );
    }
}
