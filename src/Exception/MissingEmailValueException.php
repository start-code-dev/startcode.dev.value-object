<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class MissingEmailValueException extends \Exception
{
    public function __construct()
    {
        parent::__construct(ErrorMessages::MISSING_EMAIL_MESSAGE, ErrorCodes::MISSING_EMAIL_VALUE);
    }
}
