<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\{Currency, Exception\InvalidCurrencyException};

final class CurrencyTest extends TestCase
{

    public function testCurrency() : void
    {
        $aCurrency = new Currency('EUR');
        $this->assertEquals('EUR', (string) $aCurrency);
        $this->assertEquals('€', $aCurrency->getSymbol());
        $this->assertEquals('Euro', $aCurrency->getTitle());
        $this->assertEquals(978, $aCurrency->getISO());
    }

    public function testInvalidCurrencyException() : void
    {
        $this->expectException(InvalidCurrencyException::class);
        $this->expectExceptionMessage('Currency \'tolar\' is invalid');
        $this->expectExceptionCode(60016);

        new Currency('tolar');
    }

}
