<?php

use Startcode\ValueObject\StringLiteral;
use Startcode\ValueObject\Exception\InvalidStringLiteralException;

class StringLiteralTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidString(): void
    {
        $aStringLiteral = new StringLiteral('tralala');
        $this->assertEquals('tralala', (string) $aStringLiteral);
    }

    public function testWithInvalidString(): void
    {
        $this->expectException(InvalidStringLiteralException::class);
        new StringLiteral(123.567);
    }

    public function testAppend(): void
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->append(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('tralalaaaa', (string) $modifiedString);

        $modifiedStringWithDelimiter = $modifiedString->append(new StringLiteral('b'), new StringLiteral('-'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedStringWithDelimiter);
        $this->assertEquals('tralalaaaa-b', (string) $modifiedStringWithDelimiter);
    }

    public function testEquals(): void
    {
        $aStringLiteral = new StringLiteral('tralala');

        $this->assertTrue($aStringLiteral->equals(new StringLiteral('tralala')));
        $this->assertFalse($aStringLiteral->equals(new StringLiteral('aaa')));
    }

    public function testPrepend(): void
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->prepend(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('aaatralala', (string) $modifiedString);

        $modifiedStringWithDelimiter = $modifiedString->prepend(new StringLiteral('b'), new StringLiteral('-'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedStringWithDelimiter);
        $this->assertEquals('b-aaatralala', (string) $modifiedStringWithDelimiter);
    }

    public function testIsEmpty(): void
    {
        $this->assertFalse((new StringLiteral('tralala'))->isEmpty());
        $this->assertTrue((new StringLiteral(''))->isEmpty());
    }
}