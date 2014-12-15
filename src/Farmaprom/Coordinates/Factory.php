<?php

namespace Farmaprom\Coordinates;

/**
 * Interface Factory
 * @package Farmaprom
 */
interface Factory
{
    /**
     * @param int $type
     * @return mixed
     */
    public function createCoordinates($type);
}
