<?php

namespace Farmaprom\Coordinates\Factory;

use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\CacheProvider;
use Farmaprom\Coordinates\ContentProvider;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\Coordinates\GoogleMapCoordinates;
use Farmaprom\Coordinates\Coordinates\OpenStreetMapCoordinates;
use Farmaprom\Coordinates\Factory;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\String\String;

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
     * @var CacheProvider
     */
    private $cache;

    /**
     * @var ContentProvider
     */
    private $contentProvider;

    /**
     * @var String
     */
    private $url;

    /**
     * @param Address $address
     * @param CacheProvider $cache
     * @param ContentProvider $contentProvider
     * @param String|String $url
     */
    public function __construct(Address $address, CacheProvider $cache, ContentProvider $contentProvider, String $url)
    {
        $this->address  = $address;
        $this->cache    = $cache;
        $this->contentProvider   = $contentProvider;
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
                $urlBuilder = new GoogleMapUrlBuilder($this->url);
                return new GoogleMapCoordinates($this->address, $this->cache, $this->contentProvider, $urlBuilder);
                break;
            case Coordinates::OPEN_STREET_MAP:
                return new OpenStreetMapCoordinates($this->address, $this->cache);
                break;
            default:
                return null;
        }
    }
}
