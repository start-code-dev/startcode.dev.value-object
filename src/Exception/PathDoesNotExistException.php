<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class PathDoesNotExistException extends \Exception
{
    public function __construct($path)
    {
        parent::__construct(sprintf(ErrorMessages::PATH_DOES_NOT_EXIST_MESSAGE, $path), ErrorCodes::MISSING_DIRS);
    }
}
