<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\PathDoesNotExistException;

class RealPath
{

    private string $path;

    public function __construct(string ...$parts)
    {
        $this->path = realpath(RelativePath::join($parts));
        if (empty($this->path)) {
            throw new PathDoesNotExistException(RelativePath::join($parts));
        }
    }

    public function append(string $onePart): self
    {
        return new self($this->path, $onePart);
    }

    public function __toString(): string
    {
        return $this->path;
    }

    public function diff(RealPath $pathname): StringLiteral
    {
        $diff = str_replace((string) $pathname, '', (string) $this);
        return new StringLiteral($diff);
    }
}
