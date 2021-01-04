<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidLocationException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_LOCATION_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_LOCATION_CODE
        );
    }
}
