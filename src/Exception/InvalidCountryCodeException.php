<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidCountryCodeException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_COUNTRY_CODE_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_COUNTRY_CODE
        );
    }
}
