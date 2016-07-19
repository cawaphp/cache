<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types=1);

namespace Cawa\Cache\Storage;

class Memory extends AbstractStorage
{
    /**
     * @var array
     */
    private $data = [];

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
        return isset($this->data[$key]) ? $this->data[$key][0] : false;
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
        $ttl = is_null($ttl) ? 0 : $ttl;

        $this->data[$key] = [$value, $ttl];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $key) : bool
    {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);

            return true;
        } else {
            return false;
        }
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
        $this->data = [];

        return $prefixId;
    }

    /**
     * {@inheritdoc}
     */
    public function flushAll() : bool
    {
        $this->data = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function increment(string $key, int $value)
    {
        $this->data[$key] = isset($this->data[$key]) ? $this->data[$key] + 1 : 1;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function decrement(string $key, int $value)
    {
        $this->data[$key] = isset($this->data[$key]) ? $this->data[$key] - 1 : 1;

        return true;
    }
}
