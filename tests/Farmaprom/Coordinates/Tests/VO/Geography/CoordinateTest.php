<?php

namespace Farmaprom\Coordinates\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\Coordinate;
use Farmaprom\Coordinates\VO\Geography\Latitude;
use Farmaprom\Coordinates\VO\Geography\Longitude;

/**
 * Class CoordinateTest
 * @package Farmaprom\Coordinates\Tests\VO\Geography
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    const VALID_ADDRESS_LAT = 50.062708;
    const VALID_ADDRESS_LONG = 19.9398689;

    /**
     * @var Coordinate
     */
    private $coordinate;

    public function setUp()
    {
        $latitude = new Latitude(self::VALID_ADDRESS_LAT);
        $longitude = new Longitude(self::VALID_ADDRESS_LONG);

        $this->coordinate = new Coordinate($latitude, $longitude);
    }

    public function testGetLatitude()
    {
        $this->assertSame(self::VALID_ADDRESS_LAT, $this->coordinate->getLatitude()->toNative());
    }

    public function testGetLongitude()
    {
        $this->assertSame(self::VALID_ADDRESS_LONG, $this->coordinate->getLongitude()->toNative());
    }

    public function testGetDistance()
    {
        $latitude = new Latitude(10);
        $longitude = new Longitude(20);

        $coordinate = new Coordinate($latitude, $longitude);

        $this->assertSame(3868.5, $this->coordinate->distanceFrom($coordinate));
    }
}
