<?php

namespace Startcode\ValueObject\Errors;

class ErrorMessages
{
    public const PATH_DOES_NOT_EXIST_MESSAGE    = 'Path does not exist: %s';
    public const INVALID_STRING_LITERAL_MESSAGE = 'Argument "%s" is invalid. Argument must be a STRING.';
    public const MISSING_DIRS_MESSAGE           = 'No directories to construct absolute path';
    public const INVALID_EMAIL_MESSAGE          = 'Email is invalid.';
    public const MISSING_EMAIL_MESSAGE          = 'Email value is missing.';
    public const INVALID_HTTP_METHOD_MESSAGE    = 'Value is not valid http method: %s';
    public const MISSING_HTTP_ERROR_MESSAGE     = 'Http method value is missing.';
    public const INVALID_MD5_MESSAGE            = 'String is not md5: %s';
    public const MISSING_MD5_VALUE_MESSAGE      = 'Md5 value is missing.';
    public const INVALID_INTEGER_NUMBER_MESSAGE = 'Argument "%s" is invalid. Argument must be an INTEGER.';
    public const INVALID_URL_MESSAGE            = 'Url is invalid.';
    public const INVALID_PORT_MESSAGE           = 'Argument "%s" is invalid. Argument must be a PORT NUMBER.';
    public const INVALID_IP_MESSAGE             = 'Ip "%s" is invalid.';
    public const INVALID_LATITUDE_MESSAGE       = 'Latitude %s is invalid';
    public const INVALID_LONGITUDE_MESSAGE      = 'Longitude %s is invalid';
    public const INVALID_COUNTRY_CODE_MESSAGE   = 'Country code %s is invalid';
    public const INVALID_CURRENCY_MESSAGE       = 'Currency %s is invalid';
    public const INVALID_LOCATION_MESSAGE       = 'Location %s is invalid';
    public const INVALID_PHONE_NUMBER_MESSAGE   = 'Phone number %s is invalid';
    public const INVALID_TIMEZONE_MESSAGE       = 'Timezone %s is invalid';
    public const INVALID_UUID_MESSAGE           = 'Uuid %s is invalid';
    public const INVALID_DOMAIN_MESSAGE         = 'Domain %s is invalid';
    public const INVALID_TIMESTAMP_MESSAGE      = 'Timestamp %s is invalid';
}
