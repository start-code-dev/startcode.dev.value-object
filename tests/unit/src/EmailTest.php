<?php

use Startcode\ValueObject\Email;
use Startcode\ValueObject\Exception\InvalidEmailException;
use Startcode\ValueObject\Exception\MissingEmailValueException;
use Startcode\ValueObject\Errors\ErrorMessages;
use Startcode\ValueObject\Errors\ErrorCodes;

class EmailTest extends \PHPUnit\Framework\TestCase
{
    private $validEmails = [
        'email@example.com',
        'firstname.lastname@example.com',
        'email@subdomain.example.com',
        'firstname+lastname@example.com',
        'email@[123.123.123.123]',
        '"email"@example.com',
        '1234567890@example.com',
        'email@example-one.com',
        '_______@example.com',
        'email@example.name',
        'email@example.museum',
        'email@example.co.jp',
        'firstname-lastname@example.com'
    ];

    private $invalidEmails = [
        'plainaddress',
        '#@%^%#$@#$@#.com',
        '@example.com',
        'Joe Smith <email@example.com>',
        'email.example.com',
        'email@example@example.com',
        '.email@example.com',
        'email.@example.com',
        'email..email@example.com',
        'あいうえお@example.com',
        'email@example.com (Joe Smith)',
        'email@example',
        'email@-example.com',
        'email@example.web',
        'email@111.222.333.44444',
        'email@example..com',
        'Abc..123@example.com',
        'email@123.123.123.123',
    ];

    public function testEmailToString(): void
    {
        foreach ($this->validEmails as $validEmail) {
            $this->assertEquals($validEmail, (string) new Email($validEmail));
        }
    }

    public function testBadEmail(): void
    {
        foreach ($this->invalidEmails as $invalidEmail){
            $this->expectException('\Exception');
            $this->expectExceptionCode(ErrorCodes::INVALID_EMAIL);
            $this->expectExceptionMessage(ErrorMessages::INVALID_EMAIL_MESSAGE);
            new Email($invalidEmail);
        }
    }

    public function testGetWithoutPlusAlias(): void
    {
        $this->assertEquals('test@gmail.com' , (new Email('test@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+1@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+2@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+56+56@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+56+5@gmail.com'))->getWithoutPlusAlias());
    }

    public function testEmptyEmail(): void
    {
        $this->expectException(MissingEmailValueException::class);
        (new Email(''));
    }

    public function testSpaceEmail(): void
    {
        $this->expectException(InvalidEmailException::class);
        (new Email(' '));
    }

    public function testNullEmail(): void
    {
        $this->expectException(MissingEmailValueException::class);
        (new Email(''));
    }

    public function testEquals(): void
    {
        $email = new Email('test@test.com');

        $this->assertTrue($email->equals(new Email('test@test.com')));
        $this->assertFalse($email->equals(new Email('tester@test.com')));
    }
}
