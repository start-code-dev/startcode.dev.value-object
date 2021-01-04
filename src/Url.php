<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidUrlException;
use Startcode\ValueObject\Interfaces\StringInterface;

class Url implements StringInterface
{
    public const COLON         = ':';
    public const FORWARD_SLASH = '/';
    public const QUESTION_MARK = '?';

    private string $value;

    private ?int $port = null;

    private ?string $path = null;

    private ?string $query = null;

    private ?string $scheme = null;

    private ?string $host = null;

    /**
     * Url constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->extractUrlParts($value);

        if (!filter_var($value, FILTER_VALIDATE_URL) === false) {
            $this->value = $value;
        } else {
            throw new InvalidUrlException($value);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param $values
     * @return Url
     */
    public function path(...$values): self
    {
        $this->path = join(self::FORWARD_SLASH, $values);

        return new self($this->buildUrl());
    }

    /**
     * @param PortNumber $value
     * @return Url
     */
    public function port(PortNumber $value): self
    {
        $this->port = $value->getValue();

        return new self($this->buildUrl());
    }

    /**
     * @param Dictionary $values
     * @return Url
     */
    public function query(Dictionary $values): self
    {
        $valuesArray = $values->getAll();

        if ($values->get('q') === '*:*') {
            unset($valuesArray['q']);
            $this->query = 'q=*' . urlencode(':') . '*&' . http_build_query($valuesArray);
        } else {
            $this->query = http_build_query($valuesArray);
        }

        return new self($this->buildUrl());
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        parse_str($this->query, $params);
        return $params;
    }

    /**
     * @return string
     */
    private function buildUrl(): string
    {
        return $this->scheme
            . self::COLON
            . self::FORWARD_SLASH
            . self::FORWARD_SLASH
            . $this->host
            . ($this->port ? self::COLON . $this->port : '')
            . ($this->path ? self::FORWARD_SLASH . $this->path : '')
            . ($this->query ? self::QUESTION_MARK . $this->query : '');
    }

    /**
     * @param $value
     */
    private function extractUrlParts($value): void
    {
        $urlParts = parse_url($value);

        $this->scheme = isset($urlParts['scheme']) ? $urlParts['scheme'] : null;
        $this->host   = isset($urlParts['host']) ? $urlParts['host'] : null;
        $this->port   = isset($urlParts['port']) ? $urlParts['port'] : null;
        $this->path   = isset($urlParts['path']) ? ltrim($urlParts['path'], self::FORWARD_SLASH) : null;
        $this->query  = isset($urlParts['query']) ? $urlParts['query'] : null;
    }
}
