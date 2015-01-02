<?php

namespace Farmaprom\Coordinates;

/**
 * Interface Factory
 * @package Farmaprom\Coordinates
 */
interface Factory
{
    /**
     * @param int $type
     * @return mixed
     */
    public function createCoordinates($type);
}
