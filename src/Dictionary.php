<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Interfaces\StringInterface;

class Dictionary
{

    /**
     * @var array
     */
    private $data;

    /**
     * Dictionary constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param array ...$keys
     * @return Dictionary
     */
    public function remove(...$keys): self
    {
        count($keys) > 1
            ?   array_map(function ($key) {
                    $this->removeKey($key);
            }, $keys)
            :   $this->removeKey(reset($keys));

        return new self($this->data);
    }

    /**
     * @return integer
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @return int|null|string
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * @param Dictionary $data
     * @return bool
     */
    public function equals(Dictionary $data): bool
    {
        return $this->data === $data->getAll();
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key)
            ? $this->data[$key]
            : null;
    }

    /**
     * @param array ...$keys
     * @return array|mixed|null
     */
    public function getFromDeeperLevels(...$keys)
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

    /**
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasNonEmptyValue($key): bool
    {
        return $this->has($key) && !empty($this->data[$key]);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasNotNullValue($key): bool
    {
        return $this->has($key) && $this->data[$key] !== null;
    }

    /**
     * @param array ...$keys
     * @return bool
     */
    public function hasInDeeperLevels(...$keys): bool
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

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * @param $keys
     * @return bool
     */
    public function hasKeys($keys): bool
    {
        return !empty(array_filter($keys, function ($key) {
            return $this->has($key);
        }));
    }

    /**
     * @param $key
     * @return Dictionary
     */
    public function slice($key): self
    {
        return new self($this->get($key));
    }

    /**
     * @param Dictionary $data
     * @return Dictionary
     */
    public function merge(Dictionary $data): self
    {
        return new self(
            array_merge($this->getAll(), $data->getAll())
        );
    }

    /**
     * @param StringInterface|null $delimiter
     * @return string
     */
    public function toString(StringInterface $delimiter = null): string
    {
        if ($delimiter === null) {
            return join("", $this->data);
        }
        return join((string) $delimiter, $this->data);
    }

    /**
     * @param $key
     */
    private function removeKey($key): void
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }
    }
}
