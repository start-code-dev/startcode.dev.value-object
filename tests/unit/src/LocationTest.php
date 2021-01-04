<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Startcode\ValueObject\{Location, Exception\InvalidLocationException};

final class LocationTest extends TestCase
{

    public function testToString() : void
    {
        $aLocation = new Location('site.com/search');
        $this->assertEquals('site.com/search', (string) $aLocation);
    }

    public function testAddQuery() : void
    {
        $location = new Location('site.com/search');
        $this->assertEquals('site.com/search?page=1', $location->addQuery(['page' => '1']));
    }

    public function testInvalidLocationException() : void
    {
        $this->expectException(InvalidLocationException::class);
        $this->expectExceptionMessage('Location \'*abc\' is invalid');
        $this->expectExceptionCode(60017);
        new Location('*abc');
    }

}
