<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{InvalidHttpMethodException, MissingHttpMethodValueException};

class HttpMethod
{
    public const METHOD_GET        = 'GET';
    public const METHOD_INDEX      = 'INDEX';
    public const METHOD_HEAD       = 'HEAD';
    public const METHOD_POST       = 'POST';
    public const METHOD_PUT        = 'PUT';
    public const METHOD_DELETE     = 'DELETE';
    public const METHOD_CONNECT    = 'CONNECT';
    public const METHOD_OPTIONS    = 'OPTIONS';
    public const METHOD_TRACE      = 'TRACE';
    public const METHOD_PATCH      = 'PATCH';

    private string $value;

    /**
     * @throws MissingHttpMethodValueException
     * @throws InvalidHttpMethodException
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new MissingHttpMethodValueException();
        }

        if (!in_array($value, self::validValues(), true)) {
            throw new InvalidHttpMethodException($value);
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(HttpMethod $value): bool
    {
        return $this->value === (string) $value;
    }

    public static function validValues(): array
    {
        return [
            self::METHOD_GET,
            self::METHOD_INDEX,
            self::METHOD_HEAD,
            self::METHOD_POST,
            self::METHOD_PUT,
            self::METHOD_DELETE,
            self::METHOD_CONNECT,
            self::METHOD_OPTIONS,
            self::METHOD_TRACE,
            self::METHOD_PATCH,
        ];
    }
}
