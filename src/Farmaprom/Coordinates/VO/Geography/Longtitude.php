<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\Vo\Number\Real;

/**
 * Class Longtitude
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Longtitude extends Real
{
    /**
     * @param float $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }
}
