<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\MissingDirsException;
use Startcode\ValueObject\Interfaces\StringInterface;

class RelativePath implements StringInterface
{

    /**
     * @var array
     */
    private $dirs;

    /**
     * @var string
     */
    private $path;


    /**
     * RelativePath constructor.
     * @param array ...$dirs
     * @throws PathDoesNotExistException
     */
    public function __construct(...$dirs)
    {
        if (empty($dirs)) {
            throw new MissingDirsException();
        }
        $this->dirs = $dirs;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->path === null) {
            $this->path = self::join($this->dirs);
        }
        return $this->path;
    }

    /**
     * @param array $dirs
     * @return string
     */
    public static function join(array $dirs): string
    {
        return join(DIRECTORY_SEPARATOR, $dirs);
    }
}
