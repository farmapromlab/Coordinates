<?php

namespace Farmaprom\Coordinates\Coordinates;

use Doctrine\Common\Cache\Cache;
use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Coordinate;
use Farmaprom\Coordinates\VO\Geography\Latitude;
use Farmaprom\Coordinates\VO\Geography\Longitude;
use Farmaprom\Coordinates\VO\String\String;
use Guzzle\Http\ClientInterface;

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
        $this->address = $address;
        $this->cache = $cache;
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * @return Coordinate|null
     */
    public function getCoordinate()
    {
        $urlBuilder = new GoogleMapUrlBuilder($this->url);
        $url = $urlBuilder->buildUrl($this->address);

        $cacheKey = $this->generateCacheIndex($url);
        if ($this->cache->contains($cacheKey)) {
            $addressJsonObject = $this->cache->fetch($cacheKey);
        } else {
            $addressString = $this->client->get($url);
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
