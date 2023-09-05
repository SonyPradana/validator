<?php

declare(strict_types=1);

namespace Validator;

final class Collection
{
    /** @var array<string, string> */
    private $collection = [];

    /**
     * @param array<string, string> $collection Array Collection
     */
    public function __construct($collection = [])
    {
        $this->replace($collection);
    }

    /**
     * Create new instance Collection using static method.
     *
     * @param array<string, string> $collection Array Collection
     *
     * @return Collection
     */
    public static function make($collection = [])
    {
        return new static($collection);
    }

    /**
     * @param string $key  Set item Key
     * @param string $item Set item Value
     *
     * @return void
     */
    public function __set($key, $item)
    {
        $this->set($key, $item);
    }

    /**
     * @param string $key Key tobe find
     *
     * @return string|null Items from collection
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Replace current collection with new collection.
     *
     * @param array<string, string> $collection
     */
    public function replace($collection): self
    {
        foreach ($collection as $key => $item) {
            $this->set($key, $item);
        }

        return $this;
    }

    /**
     * @param string $key Key tobe find
     *
     * @return bool True if Key is exist
     */
    public function has($key): bool
    {
        return isset($this->collection[$key]);
    }

    /**
     * Get item by using key.
     *
     * @param string      $key     Key tobe find
     * @param string|null $default Default item if key not found
     *
     * @return string|null Items from collection
     */
    public function get($key, $default = null)
    {
        return $this->collection[$key] ?? $default;
    }

    /**
     * Set Collection item by key, no exit key return new item.
     *
     * @param string $key  Set item Key
     * @param string $item Set item Value
     */
    public function set(&$key, $item): self
    {
        $this->collection[$key] = $item;

        return $this;
    }

    /**
     * Count current collection.
     */
    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * @return array<string, string> Array collection
     */
    public function all(): array
    {
        return $this->collection;
    }
}
