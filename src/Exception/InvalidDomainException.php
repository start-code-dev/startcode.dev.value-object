<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidDomainException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_DOMAIN_MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_DOMAIN_CODE
        );
    }
}
