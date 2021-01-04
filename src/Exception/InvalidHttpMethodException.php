<?php

namespace Startcode\ValueObject\Exception;

use Startcode\ValueObject\Errors\{ErrorCodes, ErrorMessages};

class InvalidHttpMethodException extends \Exception
{
    /**
     * InvalidHttpMethodException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(ErrorMessages::INVALID_HTTP_METHOD_MESSAGE, $value), ErrorCodes::INVALID_HTTP_METHOD_VALUE);
    }
}
