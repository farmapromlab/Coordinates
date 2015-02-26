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

    /**
     * @param Coordinate $coordinate
     * @param array      $distanceUnit
     *
     * @return float
     */
    public function distanceFrom(Coordinate $coordinate, array $distanceUnit = null)
    {
        if ($distanceUnit === null) {
            $distanceUnit = DistanceUnit::KM;
        }

        $theta = $this->getLongitude()->toNative() - $coordinate->getLongitude()->toNative();

        $dist = sin(deg2rad($this->getLatitude()->toNative()))
            * sin(deg2rad($coordinate->getLatitude()->toNative()))
            + cos(deg2rad($this->getLatitude()->toNative()))
            * cos(deg2rad($coordinate->getLatitude()->toNative()))
            * cos(deg2rad($theta));

        $dist = acos($dist);
        $dist = rad2deg($dist);
        $unit = $dist * 60 * $distanceUnit;

        return round($unit, 1);
    }
}
