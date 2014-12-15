<?php

namespace Farmaprom\Coordinates\Factory;

use Doctrine\Common\Cache\Cache;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\Coordinates\GoogleMapCoordinates;
use Farmaprom\Coordinates\Coordinates\OpenStreetMapCoordinates;
use Farmaprom\Coordinates\Factory;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\String\String;
use Guzzle\Http\ClientInterface;

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
     * @var ClientInterface
     */
    private $client;

    /**
     * @var String
     */
    private $url;

    /**
     * @param Address $address
     * @param Cache $cache
     * @param ClientInterface $client
     * @param String $url
     */
    public function __construct(Address $address, Cache $cache, ClientInterface $client, String $url)
    {
        $this->address  = $address;
        $this->cache    = $cache;
        $this->client   = $client;
        $this->url      = $url;
    }

    /**
     * @param int $type
     *
     * @return Coordinates|null
     */
    public function createCoordinates($type)
    {
        switch($type) {
            case Coordinates::GOOGLE_MAP:
                return new GoogleMapCoordinates($this->address, $this->cache, $this->client, $this->url);
                break;
            case Coordinates::OPEN_STREET_MAP:
                return new OpenStreetMapCoordinates($this->address, $this->cache);
                break;
        }
    }
}
