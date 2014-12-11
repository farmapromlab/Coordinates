<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Class Country
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class Country
{
    /**
     * @var String
     */
    private $code;

    /**
     * @param String $code
     */
    public function __construct(String $code)
    {
        $this->code = $code;
    }

    /**
     * @return String
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return CountryCodeName::getName($this->code);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getName();
    }
}
