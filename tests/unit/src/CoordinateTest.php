<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\{Coordinate, Exception\InvalidLongitudeException, Exception\InvalidLatitudeException};

final class CoordinateTest extends TestCase
{

    public function testToString() : void
    {
        $this->assertEquals('22.3,33.5', (string)(new Coordinate(22.3, 33.5)));
    }

    public function testGetters() : void
    {
        $aCoordinate = new Coordinate(22.3, 33.5);
        $this->assertEquals(22.3, $aCoordinate->getLatitude());
        $this->assertEquals(33.5, $aCoordinate->getLongitude());
    }

    public function testInvalidLatitude() : void
    {
        $this->expectException(InvalidLatitudeException::class);
        $this->expectExceptionMessage('Latitude 91.0 is invalid');
        $this->expectExceptionCode(60014);
        new Coordinate(91, 90);
    }

    public function testInvalidLongitude() : void
    {
        $this->expectException(InvalidLongitudeException::class);
        $this->expectExceptionMessage('Longitude 181.0 is invalid');
        $this->expectExceptionCode(60013);
        new Coordinate(90, 181);
    }

    public function testRound() : void
    {
        $aCoordinate = new Coordinate(22.31111, 33.5321);
        $aRoundedCoordinate = $aCoordinate->round();
        $this->assertEquals(22.31, $aRoundedCoordinate->getLatitude());
        $this->assertEquals(33.53, $aRoundedCoordinate->getLongitude());
    }

}
