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

class PhpGzip implements SerializerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function serialize($data) : string
    {
        $value = serialize($data);
        $compress = gzcompress($value, 1);
        if (strlen($compress) > strlen($value)) {
            return $value;
        } else {
            return $compress;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function unserialize(string $data)
    {
        $value = @gzuncompress($data);

        return !$value ? unserialize($data) : unserialize($value);
    }
}
