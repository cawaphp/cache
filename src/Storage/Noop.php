<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Cawa\Cache\Storage;

class Noop extends AbstractStorage
{
    /**
     * {@inheritdoc}
     */
    public function isVersionPrefix() : bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function multiget(array $keys) : array
    {
        $return = [];
        foreach ($keys as $key) {
            $return[$key] = $this->get($key);
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function multiset(array $keys, int $ttl = null) : array
    {
        $return = [];
        foreach ($keys as $key => $value) {
            $return[$key] = $this->set($key, $value, $ttl);
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, string $value, int $ttl = null) : bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $key) : bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function multidelete(array $keys) : int
    {
        $count = 0;
        foreach ($keys as $key) {
            $count = $count + ($this->delete($key) ? 1 : 0);
        }

        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function flush(string $prefix, int $prefixId = null) : int
    {
        return $prefixId;
    }

    /**
     * {@inheritdoc}
     */
    public function flushAll() : bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function increment(string $key, int $value)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function decrement(string $key, int $value)
    {
        return true;
    }
}
