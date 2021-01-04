<?php

use Startcode\ValueObject\Uuid;
use Startcode\ValueObject\Exception\InvalidUuidException;

class UUidTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidUuid()
    {
        $anUuid = new Uuid('d190bc0f-13d7-4cac-a8a6-40ae47d6d07a');
        $this->assertEquals('d190bc0f-13d7-4cac-a8a6-40ae47d6d07a', (string) $anUuid);
    }

    public function testWithInvalidUuid()
    {
        $this->expectException(InvalidUuidException::class);
        $this->expectExceptionMessage('Uuid \'test\' is invalid');
        $this->expectExceptionCode(60020);
        new Uuid('test');
    }

    public function testGenerate()
    {
        $anUuid = Uuid::generate();
        $this->isInstanceOf(Uuid::class, $anUuid);
    }
}
