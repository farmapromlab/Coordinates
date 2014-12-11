<?php

namespace Farmaprom\Coordinates\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Country;
use Farmaprom\Coordinates\VO\Geography\CountryCode;
use Farmaprom\Coordinates\VO\Geography\CountryCodeName;
use Farmaprom\Coordinates\VO\Geography\Street;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class AddressTest
 * @package Farmaprom\Coordinates\Tests\VO\Geography
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Address
     */
    private $address;

    public function setUp()
    {
        $street = new Street(new String("Test"), new String("22/12"));
        $country = new Country(new String(CountryCode::PL));

        $this->address = new Address($street, new String("Krakow"), $country);
    }

    public function testGetStreetName()
    {
        $this->assertSame("Test", $this->address->getStreet()->getName()->toNative());
    }

    public function testGetStreetNumber()
    {
        $this->assertSame("22/12", $this->address->getStreet()->getNumber()->toNative());
    }

    public function testGetCity()
    {
        $this->assertSame("Krakow", $this->address->getCity()->toNative());
    }

    public function testGetCountryCode()
    {
        $this->assertSame(CountryCode::PL, $this->address->getCountry()->getCode()->toNative());
    }

    public function testGetCountryName()
    {
        $this->assertSame(
            CountryCodeName::getName($this->address->getCountry()->getCode())->toNative(),
            $this->address->getCountry()->getName()->toNative()
        );
    }
}
