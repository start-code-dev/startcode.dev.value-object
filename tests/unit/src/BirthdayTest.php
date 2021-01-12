<?php

use Startcode\ValueObject\Birthday;
use Startcode\ValueObject\Exception\InvalidBirthdayException;

class BirthdayTest extends \PHPUnit\Framework\TestCase
{

    public function testGetBirthday() : void
    {
        $aBirthday = $this->birthdayFactory(2011, 1, 1)->getBirthdayDate();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory(2011, 0, 0)->getBirthdayDate();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory('2011', '1', '1')->getBirthdayDate();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory('2003', '07', '16')->getBirthdayDate();
        $this->assertEquals(
            '2003-07-16',
            $aBirthday->format('Y-m-d')
        );
    }

    public function testExceptionInFuture() : void
    {
        $this->expectException(InvalidBirthdayException::class);
        $this->expectExceptionMessage('Birthday \'Year 2030, Month 30, Day 2');
        $this->expectExceptionCode(60023);
        $this->birthdayFactory('2030', '30', '2')->getBirthdayDate();
    }

    public function testExceptionElfs() : void
    {
        $this->expectException(InvalidBirthdayException::class);
        $this->birthdayFactory('1855', '30', '2')->getBirthdayDate();
    }

    public function testGetAge() : void
    {
        $now = new \DateTime();

        $birthday = $this->birthdayFactory(1981, 12, 18);

        $this->assertEquals(
            $now->diff($birthday->getBirthdayDate())->y,
            $birthday->getAge()
        );
    }

    public function testGet18() : void
    {
        $this->assertInstanceOf(Birthday::class, Birthday::create18());
    }

    public function testFormat() : void
    {
        $aDate = $this->birthdayFactory('1961', '3', '30')->format();
        $this->assertEquals('1961-03-30', $aDate);
    }

    public function testMakeFromString() : void
    {
        $birthdayString = '1986-10-19';
        $birthday       = Birthday::makeFromString($birthdayString);

        $this->assertInstanceOf(Birthday::class, $birthday);
        $this->assertEquals($birthdayString, $birthday->format());
    }

    private function birthdayFactory($year, $month, $day) : Birthday
    {
        return new Birthday($year, $month, $day);
    }

}
