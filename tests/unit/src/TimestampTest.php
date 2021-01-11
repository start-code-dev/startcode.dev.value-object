<?php
declare(strict_types=1);

use Startcode\ValueObject\Timestamp;

final class TimestampTest extends \PHPUnit\Framework\TestCase
{

    public function testValue() : void
    {
        $time = time();
        $timestamp = new Timestamp($time);

        $this->assertInstanceOf(Timestamp::class, $timestamp);
        $this->assertSame("{$time}", (string) $timestamp);
        $this->assertSame($time, $timestamp->getValue());

        $this->assertInstanceOf(Timestamp::class, Timestamp::generate());
    }

    public function testAddDays() : void
    {
        $timestamp = new Timestamp(1600000000);
        $this->assertEquals(1600000000, $timestamp->getValue());
        $aNewTimestamp = $timestamp->addDays(10);
        $this->assertEquals(1600864000, $aNewTimestamp->getValue());
    }

    public function testIsValid() : void
    {
        $this->assertTrue(Timestamp::isValid(time()));
    }

    public function testCreateFromString() : void
    {
        $this->assertEquals(1564485051, Timestamp::createFromString('2019-07-30 13:10:51')->getValue());
    }

    public function testGetFormattedForDB() : void
    {
        $this->assertEquals('2019-07-30 15:10:51', (new Timestamp(1564492251))->getFormattedForDB());
    }

}
