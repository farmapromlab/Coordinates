<?php

namespace Farmaprom\Coordinates\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\Country;
use Farmaprom\Coordinates\VO\Geography\CountryCode;
use Farmaprom\Coordinates\VO\Geography\CountryCodeName;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class CountryTest
 * @package Farmaprom\Coordinates\Tests\VO\Geography
 */
class CountryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Country
     */
    private $country;

    public function setUp()
    {
        $this->country = new Country(new String(CountryCode::PL));
    }

    public function testCountryCode()
    {
        $this->assertSame(CountryCode::PL, $this->country->getCode()->toNative());
    }

    public function testCountryName()
    {
        $this->assertSame(CountryCodeName::getName($this->country->getCode())->toNative(), $this->country->getName()->toNative());
    }

    public function testToString()
    {
        $this->assertSame((string) $this->country, $this->country->getName()->toNative());
    }
}
