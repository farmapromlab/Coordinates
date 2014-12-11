<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Class Street
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Street
{
    /**
     * @var String
     */
    private $name;

    /**
     * @var String
     */
    private $number;

    /**
     * @param String $name
     * @param String $number
     */
    public function __construct(String $name, String $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getNumber()
    {
        return $this->number;
    }
}
