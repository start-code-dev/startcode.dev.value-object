<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Interfaces\StringInterface;

class ArrayList
{
    /**
     * @var array
     */
    private $data;

    /**
     * ArrayList constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $value
     */
    public function add($value): void
    {
        $this->data[] = $value;
    }

    /**
     * @return integer
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @param ArrayList $data
     * @return bool
     */
    public function equals(ArrayList $data): bool
    {
        return $this->data === $data->getAll();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * @param $value
     * @return bool
     */
    public function has($value): bool
    {
        return in_array($value, $this->data);
    }

    /**
     * @param $value
     * @return ArrayList
     */
    public function remove($value): self
    {
        $data   = $this->data;
        $key    = array_search($value, $this->data);

        if ($key !== false) {
            unset($data[$key]);
            $data = array_values($data);
        }
        return new self($data);
    }

    /**
     * @param StringInterface|null $delimiter
     * @return string
     */
    public function toString(StringInterface $delimiter = null): string
    {
        if ($delimiter === null) {
            $delimiter = '';
        }
        return join((string) $delimiter, $this->data);
    }
}
