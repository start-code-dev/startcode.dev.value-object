<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{MissingDirsException, PathDoesNotExistException};
use Startcode\ValueObject\Interfaces\StringInterface;

class RelativePath implements StringInterface
{

    private array $dirs;

    private ?string $path = null;

    /**
     * @throws PathDoesNotExistException
     */
    public function __construct(string ...$dirs)
    {
        if (empty($dirs)) {
            throw new MissingDirsException();
        }
        $this->dirs = $dirs;
    }

    public function __toString(): string
    {
        if ($this->path === null) {
            $this->path = self::join($this->dirs);
        }
        return $this->path;
    }

    public static function join(array $dirs): string
    {
        return implode(DIRECTORY_SEPARATOR, $dirs);
    }
}
