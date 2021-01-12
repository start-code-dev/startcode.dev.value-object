<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidProbabilityOutcomeException extends \Exception
{
    public function __construct($probability, $possibilities)
    {
        parent::__construct(
            sprintf(ErrorMessages::INVALID_PROBABILITY_OUTCOME, $possibilities, $probability),
            ErrorCodes::INVALID_PROBABILITY_OUTCOME_CODE
        );
    }
}
