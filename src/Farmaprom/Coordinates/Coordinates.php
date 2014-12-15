<?php

namespace Farmaprom\Coordinates;

use Farmaprom\Coordinates\VO\Geography\Coordinate;

/**
 * Interface Coordinates
 * @package Farmaprom
 */
interface Coordinates
{
    const GOOGLE_MAP = 1;
    const OPEN_STREET_MAP = 2;

    /**
     * @return Coordinate
     */
    public function getCoordinate();
}
