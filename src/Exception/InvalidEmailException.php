<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class InvalidEmailException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_EMAIL_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_EMAIL
        );
    }
}
