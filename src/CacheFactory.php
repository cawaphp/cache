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

namespace Cawa\Cache;

use Cawa\Core\DI;

trait CacheFactory
{
    /**
     * @param string $name
     *
     * @return Cache
     */
    private static function cache(string $name = null) : Cache
    {
        if ($return = DI::get(__METHOD__, $name)) {
            return $return;
        }

        $config = DI::config()->get('cache/' . ($name ?: 'default'));
        $item = Cache::create($config);

        return DI::set(__METHOD__, $name, $item);
    }
}
