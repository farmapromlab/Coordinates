<?php

namespace Farmaprom\Coordinates;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Interface ContentProvider
 * @package Farmaprom\Coordinates
 */
interface ContentProvider
{
    /**
     * @param String $resource
     * @return string
     */
    public function fetch(String $resource);
}