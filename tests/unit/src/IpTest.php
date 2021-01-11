<?php

use Startcode\ValueObject\Ip;
use Startcode\ValueObject\Exception\InvalidIpException;

class IpTest extends \PHPUnit\Framework\TestCase
{

    public function testToString()
    {
        $this->assertEquals('1.1.1.1', (string)(new Ip('1.1.1.1')));
    }

    public function testToString2()
    {
        $this->assertEquals('1.1.1.1', (string)(new Ip('1.1.1.1, 2.2.2.2')));
    }

    public function testExceptionInvalidIp()
    {
        $this->expectException(InvalidIpException::class);
        $this->expectExceptionMessage('Ip "\'test\'" is invalid.');
        $this->expectExceptionCode(60012);
        new Ip('test');
    }

    public function testExceptionNullIp()
    {
        $this->expectException(InvalidIpException::class);
        new Ip('');
    }


}
