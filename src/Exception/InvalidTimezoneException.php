<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidTimezoneException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_TIMEZONE_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_TIMEZONE_CODE
        );
    }
}
