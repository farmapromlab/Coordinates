<?php

namespace Farmaprom\Coordinates\CacheProvider;

use Doctrine\Common\Cache\Cache;
use Farmaprom\Coordinates\CacheProvider;

/**
 * Class DoctrineCacheProvider
 * @package Farmaprom\Coordinates\CacheProvider
 */
final class DoctrineCacheProvider implements CacheProvider
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id)
    {
        return $this->cache->fetch($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function contains($id)
    {
        return $this->cache->contains($id);
    }

    /**
     * @param $id
     * @param $data
     * @param int $lifeTime
     * @return mixed
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return $this->cache->save($id, $data, $lifeTime);
    }
}