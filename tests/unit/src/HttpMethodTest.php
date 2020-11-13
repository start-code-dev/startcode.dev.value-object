<?php

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\HttpMethod;
use Startcode\ValueObject\Exception\InvalidHttpMethodException;
use Startcode\ValueObject\Exception\MissingHttpMethodValueException;
use Startcode\ValueObject\Errors\ErrorMessages;

class HttpMethodTest extends PHPUnit_Framework_TestCase
{
    public function testToString(): void
    {
        $value = 'INDEX';

        $this->assertEquals($value, (string) (new HttpMethod($value)));
    }

    public function testInvalidValue(): void
    {
        $this->expectException(InvalidHttpMethodException::class);
        new HttpMethod('INVALID');
    }

    public function testEmptyValue(): void
    {
        $this->expectException(MissingHttpMethodValueException::class);
        (new HttpMethod(''));
    }

    public function testNullValue(): void
    {
        $this->expectException(MissingHttpMethodValueException::class);
        $this->expectExceptionMessage(ErrorMessages::MISSING_HTTP_ERROR_MESSAGE);
        $this->expectExceptionCode(ErrorCodes::MISSING_HTTP_METHOD_VALUE);
        (new HttpMethod(null));
    }

    public function testSpaceValue(): void
    {
        $value = ' ';

        $this->expectException(InvalidHttpMethodException::class);
        $this->expectExceptionMessage(sprintf(ErrorMessages::INVALID_HTTP_METHOD_MESSAGE, $value));
        $this->expectExceptionCode(ErrorCodes::INVALID_HTTP_METHOD_VALUE);
        (new HttpMethod($value));
    }

    public function testEqualsValue(): void
    {
        $httpMethodValue = new HttpMethod('GET');
        $this->assertTrue($httpMethodValue->equals(new HttpMethod('GET')));
        $this->assertFalse($httpMethodValue->equals(new HttpMethod('INDEX')));
    }
}
