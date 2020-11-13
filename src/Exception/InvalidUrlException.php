<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class InvalidUrlException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_URL_MESSAGE, \var_export($value, true)), ErrorCodes::INVALID_URL);
    }
}
