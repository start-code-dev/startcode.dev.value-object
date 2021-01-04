<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\{CountryCode, Exception\InvalidCountryCodeException};

final class CountryCodeTest extends TestCase
{

    public function testToString() : void
    {
        $this->assertEquals('RS', (string)(new CountryCode('RS')));
    }

    public function testGetName() : void
    {
        $this->assertEquals('Serbia', (new CountryCode('RS'))->getName());
    }

    public function testExceptionInvalidCode() : void
    {
        $this->expectException(InvalidCountryCodeException::class);
        $this->expectExceptionMessage('Country code \'XYZ\' is invalid');
        $this->expectExceptionCode(60015);
        new CountryCode('XYZ');
    }

}
