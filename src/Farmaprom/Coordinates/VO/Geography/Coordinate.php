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
     * @var Longitude
     */
    private $longitude;

    /**
     * @param Latitude $latitude
     * @param Longitude $longitude
     */
    public function __construct(Latitude $latitude, Longitude $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return Latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return Longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
