<?php

namespace Farmaprom\Coordinates\Tests\Coordinates;

use Doctrine\Common\Cache\ArrayCache;
use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\Coordinates\GoogleMapCoordinates;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Country;
use Farmaprom\Coordinates\VO\Geography\CountryCode;
use Farmaprom\Coordinates\VO\Geography\Street;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class GoogleMapCoordinatesTest
 * @package Farmaprom\Coordinates\Tests\Coordinates
 */
class GoogleMapCoordinatesTest extends \PHPUnit_Framework_TestCase
{
    const VALID_ADDRESS_LAT = 50.062708;
    const VALID_ADDRESS_LONG = 19.9398689;

    /**
     * @var Address
     */
    private $validAddress;

    /**
     * @var string
     */
    private $validAddresClientResponse;

    public function setUp()
    {
        $street = new Street(new String("Floriańska"), new String("15"));
        $country = new Country(new String(CountryCode::PL));
        $this->validAddress = new Address($street, new String("Krakow"), $country);

        $this->validAddresClientResponse = file_get_contents(__DIR__ . '/../Fixtures/valid_google_coordinates.json');
    }

    public function testGetCoordinateWhenLinkExistsInCache()
    {
        $cache = new ArrayCache();
        $cache->save("32257f1078ea68a422b5827025f3c166", json_decode($this->validAddresClientResponse));
        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            $cache,
            $this->getMock("Guzzle\\Http\\ClientInterface"),
            new String(GoogleMapUrlBuilder::GOOGLE_MAP_API)
        );

        $this->assertSame(self::VALID_ADDRESS_LAT, $googleMapCoordinate->getCoordinate()->getLatitude()->toNative());
        $this->assertSame(self::VALID_ADDRESS_LONG, $googleMapCoordinate->getCoordinate()->getLongitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsSuccsessful()
    {
        $client = $this->getMock("Guzzle\\Http\\ClientInterface");

        $client->expects($this->once())
            ->method("get")
            ->will($this->returnValue($this->validAddresClientResponse));

        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            new ArrayCache(),
            $client,
            new String(GoogleMapUrlBuilder::GOOGLE_MAP_API)
        );

        $this->assertSame(self::VALID_ADDRESS_LAT, $googleMapCoordinate->getCoordinate()->getLatitude()->toNative());
        $this->assertSame(self::VALID_ADDRESS_LONG, $googleMapCoordinate->getCoordinate()->getLongitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsUnsuccsessful()
    {
        $client = $this->getMock("Guzzle\\Http\\ClientInterface");
        $client->expects($this->once())
            ->method("get")
            ->will($this->returnValue(json_encode(null)));

        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            new ArrayCache(),
            $client,
            new String(GoogleMapUrlBuilder::GOOGLE_MAP_API)
        );

        $this->assertNull($googleMapCoordinate->getCoordinate());
    }
}
