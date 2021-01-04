<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\{TimeZone, Exception\InvalidTimezoneException};

final class TimeZoneTest extends TestCase
{

    public function testToString() : void
    {
        $this->assertEquals('Europe/Belgrade', (string)(new TimeZone('Europe/Belgrade')));
    }

    public function testGetZone() : void
    {
        $aTimezone = new TimeZone('Europe/Belgrade');
        $this->assertEquals('Central European Time', $aTimezone->getZone());
    }

    public function testGetGMT() : void
    {
        $aTimezone = new TimeZone('Europe/Belgrade');
        $this->assertEquals('GMT+1:00', $aTimezone->getGMTOffset());
    }

    public function testInvalidException() : void
    {
        $this->expectException(InvalidTimezoneException::class);
        $this->expectExceptionMessage('Timezone \'ABC\' is invalid');
        $this->expectExceptionCode(60019);

        new TimeZone('ABC');
    }

}
