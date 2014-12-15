<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\Vo\Number\Real;

/**
 * Class Longitude
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Longitude extends Real
{
    /**
     * @param float $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }
}
