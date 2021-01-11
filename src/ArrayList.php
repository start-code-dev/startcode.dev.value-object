<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Interfaces\StringInterface;

class ArrayList
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function add($value): void
    {
        $this->data[] = $value;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function equals(ArrayList $data): bool
    {
        return $this->data === $data->getAll();
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function has(string $value): bool
    {
        return in_array($value, $this->data);
    }

    public function remove(string $value): self
    {
        $data   = $this->data;
        $key    = array_search($value, $this->data);

        if ($key !== false) {
            unset($data[$key]);
            $data = array_values($data);
        }
        return new self($data);
    }

    public function mergeByKey(string $key, ArrayList $arrayList) : array
    {
        $tmpData = [];
        foreach ($this->data as $data) {
            foreach ($arrayList as $child) {
                if($data[$key] === $child[$key]) {
                    $tmpData[] = array_merge($data, $child);
                }
            }
        }
        return $tmpData;
    }

    public function addListByKey(string $key, ArrayList $arrayList) : array
    {
        $tmpData = [];
        foreach ($this->data as $data) {
            foreach ($arrayList as $child) {
                if($data[$key] === $child[$key]) {
                    $tmpData[] = array_merge($data, $child);
                }
            }
        }
        return $tmpData;
    }

    public function findBy(string $key, $value) : array
    {
        $tmpData = [];
        foreach ($this->data as $data) {
            if($data[$key] === $value) {
                $tmpData[] = $data;
            }
        }
        return $tmpData;
    }

    public function getByDeeperKeys(string $key) : array
    {
        $tmpData = [];
        foreach ($this->data as $data) {
            $tmpData[] = $data[$key];
        }
        return $tmpData;
    }

    public function toString(StringInterface $delimiter = null): string
    {
        if ($delimiter === null) {
            $delimiter = '';
        }
        return implode((string) $delimiter, $this->data);
    }
}
