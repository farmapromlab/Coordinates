<?php

namespace Farmaprom\Coordinates\Builder;

use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class GoogleMapUrlBuilder
 * @package Farmaprom\Coordinates\Builder
 */
final class GoogleMapUrlBuilder
{
    const GOOGLE_MAP_API = "https://maps.googleapis.com/maps/api/geocode/json?address=";

    /**
     * @var String
     */
    private $url;

    /**
     * @param String $url
     */
    public function __construct(String $url)
    {
        $this->url = $url;
    }

    /**
     * @param Address $address
     * @return String
     */
    public function buildUrl(Address $address)
    {
        $link = $this->url;
        $link .= str_replace(" ", "+", $address->getStreet()->getName() . " " . $address->getStreet()->getNumber());
        $link .= ",";
        $link .= str_replace(" ", "+", $address->getCity());

        return $link;
    }
}
