<?php

namespace Startcode\ValueObject\Errors;

class ErrorMessages
{
    const PATH_DOES_NOT_EXIST_MESSAGE = 'Path does not exist: %s';
    const INVALID_STRING_LITERAL_MESSAGE = 'Argument "%s" is invalid. Argument must be a STRING.';
    const MISSING_DIRS_MESSAGE = 'No directories to construct absolute path';
    const INVALID_EMAIL_MESSAGE = 'Email is invalid.';
    const MISSING_EMAIL_MESSAGE = 'Email value is missing.';
    const INVALID_HTTP_METHOD_MESSAGE = 'Value is not valid http method: %s';
    const MISSING_HTTP_ERROR_MESSAGE = 'Http method value is missing.';
    const INVALID_MD5_MESSAGE = 'String is not md5: %s';
    const MISSING_MD5_VALUE_MESSAGE = 'Md5 value is missing.';
    const INVALID_INTEGER_NUMER_MESSAGE = 'Argument "%s" is invalid. Argument must be an INTEGER.';
    const INVALID_URL_MESSAGE = 'Url is invalid.';
    const INVALID_PORT_MESSAGE = 'Argument "%s" is invalid. Argument must be a PORT NUMBER.';
}