<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types = 1);

namespace Cawa\Cache\Serializer;

class Php implements SerializerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function serialize($data) : string
    {
        return serialize($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function unserialize(string $data)
    {
        return unserialize($data);
    }
}
