<?php

namespace Farmaprom\Coordinates\Tests\Coordinates;

use Farmaprom\Coordinates\Coordinates\GoogleMapCoordinates;
use Farmaprom\Coordinates\Stub\Cache;
use Farmaprom\Coordinates\Stub\Client;
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
    public function testGetCoordinateWhenLinkExistsInCache()
    {
        $address = $this->getAddress();

        /** @var Cache|\PHPUnit_Framework_MockObject_MockObject $cacheProvider */
        $cacheProvider = $this->getMockBuilder("Farmaprom\\Coordinates\\Stub\\Cache")
            ->disableOriginalConstructor()
            ->getMock();

        $cacheProvider->expects($this->once())
            ->method("contains")
            ->will($this->returnValue(true));

        $object = $this->getResultObject();

        $cacheProvider->expects($this->once())
            ->method("fetch")
            ->will($this->returnValue($object));

        $googleMapCoordinate = new GoogleMapCoordinates($address, $cacheProvider, new Client());

        $coordinate = $googleMapCoordinate->getCoordinate();

        $this->assertSame(10.20, $coordinate->getLatitude()->toNative());
        $this->assertSame(30.40, $coordinate->getLongtitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsSuccsessful()
    {
        $address = $this->getAddress();

        /** @var Cache|\PHPUnit_Framework_MockObject_MockObject $cacheProvider */
        $cacheProvider = $this->getMockBuilder("Farmaprom\\Coordinates\\Stub\\Cache")
            ->disableOriginalConstructor()
            ->getMock();

        $cacheProvider->expects($this->once())
            ->method("contains")
            ->will($this->returnValue(false));

        $object = $this->getResultObject();

        /** @var Client|\PHPUnit_Framework_MockObject_MockObject $client */
        $client = $this->getMockBuilder("Farmaprom\\Coordinates\\Stub\\Client")
            ->disableOriginalConstructor()
            ->getMock();

        $client->expects($this->once())
            ->method("get")
            ->will($this->returnValue(json_encode($object)));

        $googleMapCoordinate = new GoogleMapCoordinates($address, $cacheProvider, $client);

        $coordinate = $googleMapCoordinate->getCoordinate();

        $this->assertSame(10.20, $coordinate->getLatitude()->toNative());
        $this->assertSame(30.40, $coordinate->getLongtitude()->toNative());
    }

    public function testGetCoordinateWhenLinkNotExiststInCacheAndResponseIsUnsuccsessful()
    {
        $address = $this->getAddress();

        /** @var Cache|\PHPUnit_Framework_MockObject_MockObject $cacheProvider */
        $cacheProvider = $this->getMockBuilder("Farmaprom\\Coordinates\\Stub\\Cache")
            ->disableOriginalConstructor()
            ->getMock();

        $cacheProvider->expects($this->once())
            ->method("contains")
            ->will($this->returnValue(false));

        $object = null;

        /** @var Client|\PHPUnit_Framework_MockObject_MockObject $client */
        $client = $this->getMockBuilder("Farmaprom\\Coordinates\\Stub\\Client")
            ->disableOriginalConstructor()
            ->getMock();

        $client->expects($this->once())
            ->method("get")
            ->will($this->returnValue(json_encode($object)));

        $googleMapCoordinate = new GoogleMapCoordinates($address, $cacheProvider, $client);

        $this->assertNull($googleMapCoordinate->getCoordinate());
    }

    /**
     * @return Address
     */
    private function getAddress()
    {
        $street = new Street(new String("Test"), new String("22/12"));
        $country = new Country(new String(CountryCode::PL));
        $address = new Address($street, new String("Krakow"), $country);
        return $address;
    }

    /**
     * @return \stdClass
     */
    private function getResultObject()
    {
        $results = new \stdClass();
        $results->geometry = new \stdClass();
        $results->geometry->location = new \stdClass();
        $results->geometry->location->lat = 10.20;
        $results->geometry->location->lng = 30.40;

        $object = new \stdClass();
        $object->status = "OK";
        $object->results = [
            0 => $results
        ];
        return $object;
    }
}
