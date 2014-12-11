<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\VO\Number\Real;

/**
 * Class Latitude
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Latitude extends Real
{
    /**
     * @param float $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }
}
