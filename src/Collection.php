<?php

declare(strict_types=1);

namespace Validator;

use Validator\Contract\CollectionInterface;

/**
 * Simple collection helper.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @implements CollectionInterface<TKey, TValue>
 */
final class Collection implements CollectionInterface
{
    /**
     * @var array<TKey, TValue>
     */
    private $collection = [];

    /**
     * @param array<TKey, TValue> $collection Array Collection
     */
    public function __construct($collection = [])
    {
        $this->replace($collection);
    }

    /**
     * Create new instance Collection using static method.
     *
     * @param array<TKey, TValue> $collection Array Collection
     *
     * @return Collection<TKey, TValue>
     */
    public static function make($collection = [])
    {
        return new static($collection);
    }

    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return $this->collection;
    }

    /**
     * @param TKey   $key  Set item Key
     * @param TValue $item Set item Value
     *
     * @return void
     */
    public function __set($key, $item)
    {
        $this->set($key, $item);
    }

    /**
     * @param TKey $key Key tobe find
     *
     * @return TValue|null Items from collection
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Replace current collection with new collection.
     *
     * @param array<TKey, TValue> $collection
     *
     * @return $this
     */
    public function replace($collection)
    {
        foreach ($collection as $key => $item) {
            $this->set($key, $item);
        }

        return $this;
    }

    /**
     * @param TKey $key Key tobe find
     *
     * @return bool True if Key is exist
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->collection);
    }

    /**
     * Get item by using key.
     *
     * @template TGetDefault
     *
     * @param TKey                    $key     Key tobe find
     * @param TValue|TGetDefault|null $default Default item if key not found
     *
     * @return TValue|TGetDefault|null Items from collection
     */
    public function get($key, $default = null)
    {
        return $this->collection[$key] ?? $default;
    }

    /**
     * Set Collection item by key, no exit key return new item.
     *
     * @param TKey   $key  Set item Key
     * @param TValue $item Set item Value
     *
     * @return $this
     */
    public function set($key, $item)
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
     * @return array<TKey, TValue> Array collection
     */
    public function all(): array
    {
        return $this->collection;
    }

    /**
     * @param TKey $offset
     */
    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    /**
     * @param TKey $offset
     *
     * @return TValue|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param TKey   $offset
     * @param TValue $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * @param TKey $offset
     */
    public function offsetUnset($offset): void
    {
        if ($this->has($offset)) {
            unset($this->collection[$offset]);
        }
    }

    /**
     * @return \Traversable<TKey, TValue>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->toArray());
    }
}
