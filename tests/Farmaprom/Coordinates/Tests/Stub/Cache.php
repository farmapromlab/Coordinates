<?php

namespace Farmaprom\Coordinates\Tests\Stub;

use Doctrine\Common\Cache\Cache as BaseCache;

/**
 * Class Cache
 * @package Farmaprom\Coordinates\Stub
 */
class Cache implements BaseCache
{
    public function fetch($id)
    {
    }

    public function contains($id)
    {
    }

    public function save($id, $data, $lifeTime = 0)
    {
    }

    public function delete($id)
    {
    }

    public function getStats()
    {
    }
}
