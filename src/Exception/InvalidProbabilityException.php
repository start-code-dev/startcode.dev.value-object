<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidProbabilityException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(
            sprintf(
                ErrorMessages::INVALID_PROBABILITY_MESSAGE,
                $value
            ),
            ErrorCodes::INVALID_PROBABILITY_CODE
        );
    }
}
