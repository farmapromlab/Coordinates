<?php

namespace Farmaprom\Coordinates\Coordinates;

use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\CacheProvider;
use Farmaprom\Coordinates\ContentProvider;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Coordinate;
use Farmaprom\Coordinates\VO\Geography\Latitude;
use Farmaprom\Coordinates\VO\Geography\Longitude;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class GoogleMapCoordinates
 * @package Farmaprom\Coordinates\Coordinates
 */
final class GoogleMapCoordinates implements Coordinates
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
     * @var GoogleMapUrlBuilder
     */
    private $urlBuilder;

    /**
     * @param Address $address
     * @param CacheProvider $cache
     * @param ContentProvider $contentProvider
     * @param GoogleMapUrlBuilder $urlBuilder
     */
    public function __construct(
        Address $address,
        CacheProvider $cache,
        ContentProvider $contentProvider,
        GoogleMapUrlBuilder $urlBuilder
    ) {
        $this->address = $address;
        $this->cache = $cache;
        $this->contentProvider = $contentProvider;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return Coordinate|null
     */
    public function getCoordinate()
    {
        $url = $this->urlBuilder->buildUrl($this->address);

        $cacheKey = $this->generateCacheIndex($url);
        if ($this->cache->contains($cacheKey)) {
            $addressJsonObject = $this->cache->fetch($cacheKey);
        } else {
            $addressString = $this->contentProvider->fetch(new String($url));
            $addressJsonObject = json_decode($addressString);

            if (is_object($addressJsonObject) && $addressJsonObject->status === "OK") {
                $this->cache->save($cacheKey, $addressJsonObject);
            }
        }

        if (is_object($addressJsonObject) && $addressJsonObject->status === "OK") {
            $coordinate = new Coordinate(
                new Latitude($addressJsonObject->results[0]->geometry->location->lat),
                new Longitude($addressJsonObject->results[0]->geometry->location->lng)
            );
            return $coordinate;
        }

        return null;
    }

    /**
     * @param $link
     * @return string
     */
    private function generateCacheIndex($link)
    {
        return md5($link);
    }
}
