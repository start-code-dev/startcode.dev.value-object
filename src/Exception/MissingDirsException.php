<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class MissingDirsException extends \Exception
{
    public function __construct()
    {
        parent::__construct(ErrorMessages::MISSING_DIRS_MESSAGE, ErrorCodes::MISSING_DIRS);
    }
}
