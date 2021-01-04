<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class MissingHttpMethodValueException extends \Exception
{
    /**
     * MissingHttpMethodValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(ErrorMessages::MISSING_HTTP_ERROR_MESSAGE, ErrorCodes::MISSING_HTTP_METHOD_VALUE);
    }
}
