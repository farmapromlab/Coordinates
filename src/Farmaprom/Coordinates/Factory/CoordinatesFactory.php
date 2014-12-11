<?php

namespace Farmaprom\Coordinates\Factory;

use Doctrine\Common\Cache\Cache;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\Coordinates\GoogleMapCoordinates;
use Farmaprom\Coordinates\Coordinates\OpenStreetMapCoordinates;
use Farmaprom\Coordinates\Factory;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\String\String;
use Guzzle\Http\Client;

/**
 * Class CoordinatesFactory
 * @package Farmaprom\Coordinates\Factory
 */
final class CoordinatesFactory implements Factory
{
    /**
     * @var Address
     */
    private $address;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Address $address
     * @param Cache $cache
     */
    public function __construct(Address $address, Cache $cache)
    {
        $this->address  = $address;
        $this->cache    = $cache;
        $this->client   = new Client();
    }

    /**
     * @param String $type
     *
     * @return Coordinates|null
     */
    public function createCoordinates(String $type)
    {
        switch($type) {
            case Coordinates::GOOGLE_MAP:
                return new GoogleMapCoordinates($this->address, $this->cache, $this->client);
                break;
            case Coordinates::OPEN_STREET_MAP:
                return new OpenStreetMapCoordinates($this->address, $this->cache);
                break;
        }
    }
}
