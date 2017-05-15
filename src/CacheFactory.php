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
     * @param string $name config key or class name
     *
     * @return Cache
     */
    private static function cache(string $name = null) : Cache
    {
        list($container, $config, $return) = DI::detect(__METHOD__, 'cache', $name, false);

        if ($return) {
            return $return;
        }

        if ($config) {
            $item = new Cache($config);
        } else {
            $item = new Cache(['type' => 'Noop', 'prefix' => uniqid()]);
        }

        return DI::set(__METHOD__, $container, $item);
    }
}
