<?php

use Startcode\ValueObject\Domain;
use Startcode\ValueObject\Exception\InvalidDomainException;
use Startcode\ValueObject\StringLiteral;

class DomainTest extends \PHPUnit\Framework\TestCase
{


    public function testValidDomains()
    {
        $domainName = new Domain('spanish.es');
        $this->assertEquals('spanish.es', (string) $domainName);

        $domainName = new Domain('comdomain.com');
        $this->assertEquals('comdomain.com', (string) $domainName);

        $domainName = new Domain('netdomain.net');
        $this->assertEquals('netdomain.net', (string) $domainName);

        $domainName = new Domain('french.fr');
        $this->assertEquals('french.fr', (string) $domainName);

        $domainName = new Domain('italian.it');
        $this->assertEquals('italian.it', (string) $domainName);

        $domainName = new Domain('swiss.ch');
        $this->assertEquals('swiss.ch', (string) $domainName);

        $domainName = new Domain('swedish.se');
        $this->assertEquals('swedish.se', (string) $domainName);

        $domainName = new Domain('norwegian.no');
        $this->assertEquals('norwegian.no', (string) $domainName);

        $domainName = new Domain(' www.swedish.se');
        $this->assertEquals('www.swedish.se', (string) $domainName);
    }

    public function testInvalidDomain()
    {
        $this->expectException(InvalidDomainException::class);
        new Domain('s---a%%%%%%aaa1.a.coco');
    }

    public function testEquals()
    {
        $domainNameOne = new Domain('google.com');
        $domainNameTwo = new Domain('google.com');
        $domainNameThree = new Domain('google.de');

        $this->assertTrue($domainNameOne->equals($domainNameTwo));
        $this->assertFalse($domainNameTwo->equals($domainNameThree));
    }

    public function testAppend()
    {
        $domainName = new Domain('google.com');
        $appended   = $domainName->append(new StringLiteral('int'), new StringLiteral('dev'));

        $this->assertInstanceOf(Domain::class, $appended);
        $this->assertEquals('google.com.int.dev', (string) $appended);
    }

    public function testPrepend()
    {
        $domainName = new Domain('google.com');
        $prepended  = $domainName->prepend(new StringLiteral('www'), new StringLiteral('beta'));

        $this->assertInstanceOf(Domain::class, $prepended);
        $this->assertEquals('www.beta.google.com', (string) $prepended);
    }

    public function testGetTopLevelDomainName()
    {
        $topLevel = (new Domain('www.google.com'))->getTopLevelDomainName();

        $this->assertInstanceOf(StringLiteral::class, $topLevel);
        $this->assertEquals('com', (string) $topLevel);
    }

    public function testGetFirstLevelDomainName()
    {
        $firstLevel = (new Domain('www.google.com'))->getFirstLevelDomainName();

        $this->assertInstanceOf(Domain::class, $firstLevel);
        $this->assertEquals('google.com', (string) $firstLevel);

        $this->assertEquals('google.com', (string) (new Domain('a1.www.google.com'))->getFirstLevelDomainName());
        $this->assertEquals('google.com', (string) (new Domain('google.com'))->getFirstLevelDomainName());

        $this->assertEquals('foo-bar-baz.com', (string) (new Domain('a1.www.foo-bar-baz.com'))->getFirstLevelDomainName());
        $this->assertEquals('foo-bar-baz.com', (string) (new Domain('foo-bar-baz.com'))->getFirstLevelDomainName());

        $this->assertEquals('bla-bla.org', (string) (new Domain('d1.www.bla-bla.org'))->getFirstLevelDomainName());
        $this->assertEquals('bla-bla.org', (string) (new Domain('bla-bla.org'))->getFirstLevelDomainName());

        $this->assertEquals('domain.co.uk', (string) (new Domain('a1.www.domain.co.uk'))->getFirstLevelDomainName());
        $this->assertEquals('domain.co.uk', (string) (new Domain('domain.co.uk'))->getFirstLevelDomainName());

        $this->assertEquals('domain.de', (string) (new Domain('a1.www.domain.de'))->getFirstLevelDomainName());
        $this->assertEquals('domain.de', (string) (new Domain('domain.de'))->getFirstLevelDomainName());

        $this->assertEquals('domain.online', (string) (new Domain('subdomain.domain.online'))->getFirstLevelDomainName());
        $this->assertEquals('domain.online', (string) (new Domain('domain.online'))->getFirstLevelDomainName());

        $this->assertEquals('domain.fi', (string) (new Domain('subdomain.domain.fi'))->getFirstLevelDomainName());
        $this->assertEquals('domain.fi', (string) (new Domain('domain.fi'))->getFirstLevelDomainName());

        $this->assertEquals('domain.it', (string) (new Domain('subdomain.domain.it'))->getFirstLevelDomainName());
        $this->assertEquals('domain.it', (string) (new Domain('domain.it'))->getFirstLevelDomainName());

        $this->assertEquals('domain.fr', (string) (new Domain('subdomain.domain.fr'))->getFirstLevelDomainName());
        $this->assertEquals('domain.fr', (string) (new Domain('domain.fr'))->getFirstLevelDomainName());

        $this->assertEquals('domain.se', (string) (new Domain('subdomain.domain.se'))->getFirstLevelDomainName());
        $this->assertEquals('domain.se', (string) (new Domain('domain.se'))->getFirstLevelDomainName());

        $this->assertEquals('domain.dk', (string) (new Domain('subdomain.domain.dk'))->getFirstLevelDomainName());
        $this->assertEquals('domain.dk', (string) (new Domain('domain.dk'))->getFirstLevelDomainName());

        $this->assertEquals('domain.co.uk', (string) (new Domain('subdomain.domain.co.uk'))->getFirstLevelDomainName());
        $this->assertEquals('domain.co.uk', (string) (new Domain('domain.co.uk'))->getFirstLevelDomainName());
    }

    public function testDiff()
    {
        $diff = (new Domain('www.google.com'))->diff(new Domain('google.com'));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('www', (string) $diff);

        $this->assertEquals('www.beta', (string) (new Domain('www.beta.google.com'))->diff(new Domain('google.com')));
        $this->assertEquals('', (string) (new Domain('google.com'))->diff(new Domain('google.com')));
    }

    public function testTruncate()
    {
        $domain = (new Domain('www.google.com'))->truncate(new StringLiteral('www'));

        $this->assertInstanceOf(Domain::class, $domain);
        $this->assertEquals('google.com', (string) $domain);

        $domain = (new Domain('t1.www.google.com.ch'))->truncate(
            new StringLiteral('t1'),
            new StringLiteral('ch'), new StringLiteral('www'));
        $this->assertEquals('google.com', (string) $domain);
    }
}
