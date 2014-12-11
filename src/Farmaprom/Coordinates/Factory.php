<?php

namespace Farmaprom\Coordinates;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Interface Factory
 * @package Farmaprom
 */
interface Factory
{
    /**
     * @param String $type
     * @return mixed
     */
    public function createCoordinates(String $type);
}
