<?php

use Startcode\ValueObject\Errors\ErrorCodes;
use Startcode\ValueObject\Errors\ErrorMessages;
use Startcode\ValueObject\Md5;
use Startcode\ValueObject\Exception\InvalidMd5Exception;
use Startcode\ValueObject\Exception\MissingMd5ValueException;

class Md5Test extends PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $value = '7E4ef92d1472fa1a2d41b2d3c1d2b77a';

        $this->assertEquals($value, (string) (new Md5($value)));
    }

    public function testInvalidValue()
    {
        $this->expectException(InvalidMd5Exception::class);

        new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a3');
    }

    public function testCalculateMd5()
    {
        $md5 = Md5::calculateMd5('tralala');

        $this->assertInstanceOf(Md5::class, $md5);
    }

    public function testEmptyMd5Value()
    {
        $this->expectException(MissingMd5ValueException::class);
        $this->expectExceptionMessage(ErrorMessages::MISSING_MD5_VALUE_MESSAGE);
        $this->expectExceptionCode(ErrorCodes::MISSING_MD5_VALUE);
        (new Md5(''));
    }

    public function testNullMd5Value()
    {
        $this->expectException(MissingMd5ValueException::class);
        $this->expectExceptionMessage(ErrorMessages::MISSING_MD5_VALUE_MESSAGE);
        $this->expectExceptionCode(ErrorCodes::MISSING_MD5_VALUE);
        (new Md5(''));
    }

    public function testSpaceMd5Value()
    {
        $value = ' ';

        $this->expectException(InvalidMd5Exception::class);
        $this->expectExceptionMessage(sprintf(ErrorMessages::INVALID_MD5_MESSAGE, $value));
        $this->expectExceptionCode(ErrorCodes::INVALID_MD5);
        (new Md5($value));
    }

    public function testEqualsMd5Value()
    {
        $md5Value = new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a');
        $this->assertTrue($md5Value->equals(new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a')));
        $this->assertFalse($md5Value->equals(new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77b')));
    }
}
