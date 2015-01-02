<?php

namespace Farmaprom\Coordinates\Tests\CacheProvider;

use Doctrine\Common\Cache\ArrayCache;
use Farmaprom\Coordinates\CacheProvider\DoctrineCacheProvider;

/**
 * Class DoctrineCacheProviderTest
 * @package Farmaprom\Coordinates\Tests\CacheProvider
 */
class DoctrineCacheProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchWhenStringExistsInCache()
    {
        $arrayCache = new ArrayCache();
        $arrayCache->save("test", "string_test");

        $cache = new DoctrineCacheProvider($arrayCache);

        $this->assertSame("string_test", $cache->fetch("test"));
    }

    public function testFetchWhenStringNotExistsInCache()
    {
        $cache = new DoctrineCacheProvider(new ArrayCache());

        $this->assertFalse($cache->fetch("test"));
    }

    public function testContainsWhenStringExistsInCache()
    {
        $arrayCache = new ArrayCache();
        $arrayCache->save("test", "string_test");

        $cache = new DoctrineCacheProvider($arrayCache);

        $this->assertTrue($cache->contains("test"));
    }

    public function testContainsWhenStringNotExistsInCache()
    {
        $cache = new DoctrineCacheProvider(new ArrayCache());

        $this->assertFalse($cache->contains("test"));
    }
}
