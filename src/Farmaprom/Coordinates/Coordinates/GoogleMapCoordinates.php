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
    private $cacheProvider;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param Address $address
     * @param Cache $cacheProvider
     * @param ClientInterface $client
     */
    public function __construct(Address $address, Cache $cacheProvider, ClientInterface $client)
    {
        $this->address = $address;
        $this->cacheProvider = $cacheProvider;
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

        if ($this->cacheProvider->contains($link)) {
            $address = $this->cacheProvider->fetch($link);
        } else {
            $address = $this->client->get($link);
            $address = json_decode($address);

            if (is_object($address) && $address->status === "OK") {
                $this->cacheProvider->save($link, $address);
            }
        }

        if (is_object($address) && $address->status === "OK") {
            $coordinate = new Coordinate(
                new Latitude($address->results[0]->geometry->location->lat),
                new Longtitude($address->results[0]->geometry->location->lng)
            );
            return $coordinate;
        }

        return null;
    }
}
