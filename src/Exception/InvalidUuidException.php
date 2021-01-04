<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidUuidException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_UUID_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_UUID_CODE
        );
    }
}
