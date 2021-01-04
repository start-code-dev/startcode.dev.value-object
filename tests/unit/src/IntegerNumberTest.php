<?php

use Startcode\ValueObject\IntegerNumber;
use Startcode\ValueObject\Exception\InvalidIntegerNumberException;

class IntegerNumberTest extends \PHPUnit_Framework_TestCase
{

    public function testValidInteger(): void
    {
        $integerNumber = new IntegerNumber(12);
        $this->assertEquals(12, $integerNumber->getValue());

        $integerNumber = new IntegerNumber("12");
        $this->assertEquals(12, $integerNumber->getValue());
    }

    public function testToString(): void
    {
        $integerNumber = new IntegerNumber("12");
        $this->assertEquals("12", (string) $integerNumber);
    }

    public function testFloat(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(12.5);
    }

    public function testNull(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(null);
    }

    public function testFalse(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(false);
    }

    public function testTrue(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(true);
    }

    public function testSpace(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(' ');
    }

    public function testEmptyString(): void
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber('');
    }

    public function testEquals(): void
    {
        $integerNumber = new IntegerNumber(12);
        $this->assertTrue($integerNumber->equals(new IntegerNumber(12)));
        $this->assertFalse($integerNumber->equals(new IntegerNumber(10)));

        $integerNumber = new IntegerNumber("12");
        $this->assertTrue($integerNumber->equals(new IntegerNumber(12)));
        $this->assertFalse($integerNumber->equals(new IntegerNumber(10)));
    }

    public function testIsZeroValue(): void
    {
        $this->assertTrue((new IntegerNumber(0))->isZeroValue());
    }
}
