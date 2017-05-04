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

interface SerializerInterface
{
    /**
     * @param mixed $data
     *
     * @return string|mixed
     */
    public static function serialize($data) : string ;

    /**
     * @param string $data
     *
     * @return mixed
     */
    public static function unserialize(string $data);
}
