<?php

namespace Farmaprom\Coordinates;

use Farmaprom\Coordinates\VO\Geography\Coordinate;

/**
 * Interface Coordinates
 * @package Farmaprom
 */
interface Coordinates
{
    const GOOGLE_MAP = "google_map";
    const OPEN_STREET_MAP = "open_street_map";

    /**
     * @return Coordinate
     */
    public function getCoordinate();
}
