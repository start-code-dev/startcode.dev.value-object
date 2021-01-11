<?php

use Startcode\ValueObject\RelativePath;
use Startcode\ValueObject\Exception\MissingDirsException;

class RelativePathTest extends \PHPUnit\Framework\TestCase
{

    public function testPath(): void
    {
        $relativePath = new RelativePath(__DIR__, 'RelativePathTest.php');
        $this->assertEquals(
            join(DIRECTORY_SEPARATOR, [__DIR__, 'RelativePathTest.php']),
            (string) $relativePath
        );
    }

    public function testMissingDirs(): void
    {
        $this->expectException(MissingDirsException::class);
        new RelativePath();
    }
}
