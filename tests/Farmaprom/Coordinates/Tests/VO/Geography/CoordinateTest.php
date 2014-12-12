<?php

namespace Farmaprom\Coordinates\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\Coordinate;
use Farmaprom\Coordinates\VO\Geography\Latitude;
use Farmaprom\Coordinates\VO\Geography\Longtitude;

/**
 * Class CoordinateTest
 * @package Farmaprom\Coordinates\Tests\VO\Geography
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Coordinate
     */
    private $coordinate;

    public function setUp()
    {
        $latitude = new Latitude(12.456);
        $longtitude = new Longtitude(98.765);

        $this->coordinate = new Coordinate($latitude, $longtitude);
    }

    public function testGetLatitude()
    {
        $this->assertSame(12.456, $this->coordinate->getLatitude()->toNative());
    }

    public function testGetLongtitude()
    {
        $this->assertSame(98.765, $this->coordinate->getLongtitude()->toNative());
    }
}
