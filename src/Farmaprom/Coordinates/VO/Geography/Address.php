<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Class Address
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Address
{
    /**
     * @var Street
     */
    private $street;

    /**
     * @var String
     */
    private $city;

    /**
     * @var Country
     */
    private $country;

    /**
     * @param Street $street
     * @param String $city
     * @param Country $country
     */
    public function __construct(Street $street, String $city, Country $country)
    {
        $this->street   = $street;
        $this->city     = $city;
        $this->country  = $country;
    }

    /**
     * @return Street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }
}
