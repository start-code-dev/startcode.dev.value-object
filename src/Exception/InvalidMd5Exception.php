<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;

class InvalidMd5Exception extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_MD5_MESSAGE, $value), ErrorCodes::INVALID_MD5);
    }
}
