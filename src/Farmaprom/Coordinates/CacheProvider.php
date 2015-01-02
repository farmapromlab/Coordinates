<?php

namespace Farmaprom\Coordinates;

/**
 * Interface CacheProvider
 * @package Farmaprom\Coordinates
 */
interface CacheProvider
{
    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id);

    /**
     * @param $id
     * @return mixed
     */
    public function contains($id);

    /**
     * @param $id
     * @param $data
     * @param int $lifeTime
     * @return mixed
     */
    public function save($id, $data, $lifeTime = 0);
}