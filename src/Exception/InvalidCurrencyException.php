<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidCurrencyException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_CURRENCY_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_CURRENCY_CODE
        );
    }
}
