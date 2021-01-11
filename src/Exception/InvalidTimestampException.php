<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidTimestampException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_TIMESTAMP_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_TIMESTAMP_CODE
        );
    }
}
