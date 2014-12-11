<?php

namespace Farmaprom\Coordinates\VO\Geography;

/**
 * Class Coordinate
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Coordinate
{
    /**
     * @var Latitude
     */
    private $latitude;

    /**
     * @var Longtitude
     */
    private $longtitude;

    /**
     * @param Latitude $latitude
     * @param Longtitude $longtitude
     */
    public function __construct(Latitude $latitude, Longtitude $longtitude)
    {
        $this->latitude = $latitude;
        $this->longtitude = $longtitude;
    }

    /**
     * @return Latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return Longtitude
     */
    public function getLongtitude()
    {
        return $this->longtitude;
    }
}
