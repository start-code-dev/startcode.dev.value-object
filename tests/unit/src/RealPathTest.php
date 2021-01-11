<?php

use Startcode\ValueObject\RealPath;
use Startcode\ValueObject\StringLiteral;
use Startcode\ValueObject\Exception\PathDoesNotExistException;

class RealPathTest extends \PHPUnit\Framework\TestCase
{
//    public function testToString(): void
//    {
//        $path = new RealPath(__DIR__, basename(__FILE__));
//
//        $this->assertEquals(__FILE__, (string) $path);
//    }

    public function testInvalidPath(): void
    {
        $this->expectException(PathDoesNotExistException::class);
        (string) (new RealPath(__DIR__, 'path'));
    }

    public function testDiff(): void
    {
        $diff = (new RealPath(__FILE__))->diff(new RealPath(__DIR__));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('/RealPathTest.php', (string) $diff);
    }

    public function testAppend(): void
    {
        $realPathDir = new RealPath(__DIR__);
        $realPathFile = $realPathDir->append(basename(__FILE__));

        $this->assertInstanceOf(RealPath::class, $realPathFile);
        $this->assertEquals(__FILE__, (string) $realPathFile);
    }
}
