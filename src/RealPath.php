<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\PathDoesNotExistException;

class RealPath
{

    /**
     * @var string
     */
    private $path;

    /**
     * RealPath constructor.
     * @param array ...$parts
     * @throws PathDoesNotExistException
     */
    public function __construct(...$parts)
    {
        $this->path = realpath(RelativePath::join($parts));
        if ($this->path === false) {
            throw new PathDoesNotExistException(RelativePath::join($parts));
        }
    }

    /**
     * @param $onePart
     * @return RealPath
     */
    public function append($onePart): self
    {
        return new self($this->path, $onePart);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->path;
    }

    /**
     * @param Pathname $pathname
     * @return StringLiteral
     */
    public function diff(RealPath $pathname): StringLiteral
    {
        $diff = str_replace((string) $pathname, '', $this->__toString());
        return new StringLiteral($diff);
    }
}
