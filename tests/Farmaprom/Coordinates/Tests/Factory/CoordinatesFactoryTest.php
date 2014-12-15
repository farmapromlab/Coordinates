<?php

namespace Farmaprom\Coordinates\Tests\Factory;

use Doctrine\Common\Cache\ArrayCache;
use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\Coordinates;
use Farmaprom\Coordinates\Factory\CoordinatesFactory;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Street;
use Farmaprom\Coordinates\VO\String\String;
use Farmaprom\Coordinates\VO\Geography\Country;
use Farmaprom\Coordinates\VO\Geography\CountryCode;

/**
 * Class CoordinatesFactoryTest
 * @package Farmaprom\Coordinates\Tests\Factory
 */
class CoordinatesFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $street = new Street(new String("Test"), new String("22/12"));
        $country = new Country(new String(CountryCode::PL));

        $address = new Address($street, new String("Krakow"), $country);

        $coordinateCreator = new CoordinatesFactory(
            $address,
            new ArrayCache(),
            $this->getMock("Guzzle\\Http\\ClientInterface"),
            new String(GoogleMapUrlBuilder::GOOGLE_MAP_API)
        );

        $this->assertInstanceOf("Farmaprom\\Coordinates\\Factory", $coordinateCreator);
    }

    public function testCreateCoordinates()
    {
        $street = new Street(new String("Test"), new String("22/12"));
        $country = new Country(new String(CountryCode::PL));

        $address = new Address($street, new String("Krakow"), $country);

        $coordinateCreator = new CoordinatesFactory(
            $address,
            new ArrayCache(),
            $this->getMock("Guzzle\\Http\\ClientInterface"),
            new String(GoogleMapUrlBuilder::GOOGLE_MAP_API)
        );

        $create = $coordinateCreator->createCoordinates(Coordinates::OPEN_STREET_MAP);
        $this->assertInstanceOf("Farmaprom\\Coordinates\\Coordinates\\OpenStreetMapCoordinates", $create);

        $create = $coordinateCreator->createCoordinates(Coordinates::GOOGLE_MAP);
        $this->assertInstanceOf("Farmaprom\\Coordinates\\Coordinates\\GoogleMapCoordinates", $create);

        $create = $coordinateCreator->createCoordinates(12);
        $this->assertNull($create);
    }
}
