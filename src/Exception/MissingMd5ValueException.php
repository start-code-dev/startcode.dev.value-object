<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class MissingMd5ValueException extends \Exception
{
    /**
     * MissingMd5ValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(ErrorMessages::MISSING_MD5_VALUE_MESSAGE, ErrorCodes::MISSING_MD5_VALUE);
    }
}
