<?php

namespace Farmaprom\Coordinates\Coordinates;

use Farmaprom\Coordinates\CacheProvider;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Coordinate;

/**
 * Class OpenStreetMapCoordinates
 * @package Farmaprom\Coordinates\Coordinates
 */
class OpenStreetMapCoordinates implements Coordinates
{
    /**
     * @var Address
     */
    private $address;

    /**
     * @var CacheProvider
     */
    private $cacheProvider;

    /**
     * @param Address $address
     * @param CacheProvider $cacheProvider
     */
    public function __construct(Address $address, CacheProvider $cacheProvider)
    {
        $this->address = $address;
        $this->cacheProvider = $cacheProvider;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        // TODO: Implement getCoordinate() method.
    }
}
