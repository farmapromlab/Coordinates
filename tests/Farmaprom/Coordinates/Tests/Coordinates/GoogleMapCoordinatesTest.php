<?php

namespace Farmaprom\Coordinates\Tests\Coordinates;

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
        $cache = $this->getMock("Farmaprom\\Coordinates\\CacheProvider");
        $cache->expects($this->once())
            ->method("contains")
            ->will($this->returnValue(true));

        $cache->expects($this->once())
            ->method("fetch")
            ->will($this->returnValue(json_decode($this->validAddresClientResponse)));

        $urlBuilder = new GoogleMapUrlBuilder(new String(GoogleMapUrlBuilder::GOOGLE_MAP_API));

        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            $cache,
            $this->getMock("Farmaprom\\Coordinates\\ContentProvider"),
            $urlBuilder
        );

        $coordinate = $googleMapCoordinate->getCoordinate();

        $this->assertSame(self::VALID_ADDRESS_LAT, $coordinate->getLatitude()->toNative());
        $this->assertSame(self::VALID_ADDRESS_LONG, $coordinate->getLongitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsSuccsessful()
    {
        $cache = $this->getMock("Farmaprom\\Coordinates\\CacheProvider");
        $cache->expects($this->once())
            ->method("contains")
            ->will($this->returnValue(false));

        $client = $this->getMock("Farmaprom\\Coordinates\\ContentProvider");
        $client->expects($this->once())
            ->method("fetch")
            ->will($this->returnValue($this->validAddresClientResponse));

        $urlBuilder = new GoogleMapUrlBuilder(new String(GoogleMapUrlBuilder::GOOGLE_MAP_API));

        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            $cache,
            $client,
            $urlBuilder
        );

        $coordinate = $googleMapCoordinate->getCoordinate();

        $this->assertSame(self::VALID_ADDRESS_LAT, $coordinate->getLatitude()->toNative());
        $this->assertSame(self::VALID_ADDRESS_LONG, $coordinate->getLongitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsUnsuccsessful()
    {
        $cache = $this->getMock("Farmaprom\\Coordinates\\CacheProvider");
        $cache->expects($this->any())
            ->method("contains")
            ->will($this->returnValue(false));

        $client = $this->getMock("Farmaprom\\Coordinates\\ContentProvider");
        $client->expects($this->once())
            ->method("fetch")
            ->will($this->returnValue(json_encode(null)));

        $urlBuilder = new GoogleMapUrlBuilder(new String(GoogleMapUrlBuilder::GOOGLE_MAP_API));

        $googleMapCoordinate = new GoogleMapCoordinates(
            $this->validAddress,
            $cache,
            $client,
            $urlBuilder
        );

        $this->assertNull($googleMapCoordinate->getCoordinate());
    }
}
