<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidDomainException;
use Startcode\ValueObject\Interfaces\StringInterface;

class Domain implements StringInterface
{

    public const DELIMITER = '.';

    private string $value;

    /**
     * @throws InvalidDomainException
     */
    public function __construct(string $value)
    {
        $value = trim($value);
        if (!$this->isValid($value)) {
            throw new InvalidDomainException($value);
        }
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function diff(Domain $domainName) : StringLiteral
    {
        $diff = str_replace((string) $domainName, '', (string) $this);
        $diff = preg_replace('/\.$/xuis', '', $diff);
        return new StringLiteral($diff);
    }

    public function equals(Domain $domainName) : bool
    {
        return (string)$this === (string)$domainName;
    }

    public function getFirstLevelDomainName() : Domain
    {
        $domain = preg_replace('#^(?:.+?\\.)+(.+?\\.(?:at|au|ca|ch|chat|co|com|de|dk|es|fr|fi|it|net|no|org|online|pt|rs|se|co\\.uk))#', '$1', (string)$this);
        return new self($domain);
    }

    public function getTopLevelDomainName() : StringLiteral
    {
        preg_match('/\.((?!\d+)[a-zA-Zå\d]{1,63})$/xuis', (string)$this, $matches);

        return new StringLiteral($matches[1]);
    }

    public function append(StringInterface ...$value) : Domain
    {
        array_unshift($value, (string)$this);
        return new self(implode(self::DELIMITER, $value));
    }

    public function prepend(StringInterface ...$value) : Domain
    {
        $value[] = (string)$this;
        return new self(implode(self::DELIMITER, $value));
    }

    public function truncate(StringInterface ...$value) : Domain
    {
        $parts = explode(self::DELIMITER, (string)$this);
        $truncated = array_diff($parts, $value);
        return new self(implode(self::DELIMITER, $truncated));
    }

    protected function isValid($value) : bool
    {
        return \is_string($value)
            && preg_match(
                '/^(?!\-)(?:[a-zA-Zå\d\-]{0,62}[a-zA-Zå\d]\.){1,126}(?!\d+)[a-zA-Zå\d]{1,63}$/uxis',
                $value
            ) === 1;
    }
}
