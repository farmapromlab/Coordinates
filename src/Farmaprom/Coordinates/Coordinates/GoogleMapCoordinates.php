<?php

namespace Farmaprom\Coordinates\Coordinates;

use Doctrine\Common\Cache\Cache;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Coordinate;
use Farmaprom\Coordinates\VO\Geography\Latitude;
use Farmaprom\Coordinates\VO\Geography\Longtitude;
use Guzzle\Http\ClientInterface;

/**
 * Class GoogleMapCoordinates
 * @package Farmaprom\Coordinates\Coordinates
 */
final class GoogleMapCoordinates implements Coordinates
{
    const GOOGLE_MAP_API = "https://maps.googleapis.com/maps/api/geocode/json?address=";

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
     * @param Address $address
     * @param Cache $cache
     * @param ClientInterface $client
     */
    public function __construct(Address $address, Cache $cache, ClientInterface $client)
    {
        $this->address = $address;
        $this->cache = $cache;
        $this->client = $client;
    }

    /**
     * @return Coordinate|null
     */
    public function getCoordinate()
    {
        $link = self::GOOGLE_MAP_API;
        $link .= str_replace(" ", "+", $this->address->getStreet()->getName() . " " . $this->address->getStreet()->getNumber());
        $link .= ",";
        $link .= str_replace(" ", "+", $this->address->getCity());

        $cacheKey = $this->generateCacheIndex($link);
        if ($this->cache->contains($cacheKey)) {
            $addressJsonObject = $this->cache->fetch($cacheKey);
        } else {
            $addressString = $this->client->get($link);
            $addressJsonObject = json_decode($addressString);

            if (is_object($addressJsonObject) && $addressJsonObject->status === "OK") {
                $this->cache->save($cacheKey, $addressJsonObject);
            }
        }

        if (is_object($addressJsonObject) && $addressJsonObject->status === "OK") {
            $coordinate = new Coordinate(
                new Latitude($addressJsonObject->results[0]->geometry->location->lat),
                new Longtitude($addressJsonObject->results[0]->geometry->location->lng)
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
