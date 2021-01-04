<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\PhoneNumber;
use Startcode\ValueObject\Exception\InvalidPhoneNumberException;

final class PhoneNumberTest extends TestCase
{

    public function testNumbers() : void
    {
        $this->assertEquals('38163888777', (string) new PhoneNumber('38163888777'));
        $this->assertEquals('+38163888777', (string) new PhoneNumber('+38163888777'));
        $this->assertEquals('381-63-888-777', (string) new PhoneNumber('381-63-888-777'));
        $this->assertEquals('063888777', (string) new PhoneNumber('063888777'));
        $this->assertEquals('0638887775', (string) new PhoneNumber('0638887775'));
        $this->assertEquals('06388877755', (string) new PhoneNumber('06388877755'));
        $this->assertEquals('38163888777', (string) new PhoneNumber('38163888777!'));
    }

    public function testInvalidLength() : void
    {
        $this->expectException(InvalidPhoneNumberException::class);
        new PhoneNumber('0114342');
    }

    public function testInvalidType() : void
    {
        $this->expectException(InvalidPhoneNumberException::class);
        new PhoneNumber('INVALID');
    }


}
