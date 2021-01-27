<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Interfaces\StringInterface;

class Dictionary
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function add(string $key, string $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function addInt(string $key, int $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function addArray(string $key, array $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function remove(string ...$keys): self
    {
        count($keys) > 1
            ?   array_map(function ($key) {
                    $this->removeKey($key);
            }, $keys)
            :   $this->removeKey(reset($keys));

        return new self($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function key(): ?string
    {
        return key($this->data);
    }

    public function equals(Dictionary $data): bool
    {
        return $this->data === $data->getAll();
    }

    /**
     * @return array|mixed|null
     */
    public function get(string $key)
    {
        return $this->has($key)
            ? $this->data[$key]
            : null;
    }

    /**
     * @return array|mixed|null
     */
    public function getFromDeeperLevels(string ...$keys)
    {
        $data = $this->data;
        foreach ($keys as $keyIndex => $aKey) {
            if (is_array($data) && array_key_exists($aKey, $data)) {
                $data = $data[$aKey];
            } else {
                $data = null;
                break;
            }
        }
        return $data;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function hasNonEmptyValue(string $key): bool
    {
        return $this->has($key) && !empty($this->data[$key]);
    }

    public function hasNotNullValue(string $key): bool
    {
        return $this->has($key) && $this->data[$key] !== null;
    }

    public function hasInDeeperLevels(string ...$keys): bool
    {
        $data = $this->data;
        $has = false;
        foreach ($keys as $aKey) {
            if (is_array($data) && array_key_exists($aKey, $data)) {
                $data = $data[$aKey];
                $has = true;
            } else {
                $has = false;
                break;
            }
        }
        return $has;
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function hasKeys(array $keys): bool
    {
        return !empty(array_filter($keys, function ($key) {
            return $this->has($key);
        }));
    }

    public function slice(string $key): self
    {
        return new self($this->get($key));
    }

    public function merge(Dictionary $data): self
    {
        return new self(
            array_merge($this->getAll(), $data->getAll())
        );
    }

    public function toString(StringInterface $delimiter = null): string
    {
        if ($delimiter === null) {
            return implode('', $this->data);
        }
        return implode((string) $delimiter, $this->data);
    }

    private function removeKey(string $key): void
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }
    }
}
