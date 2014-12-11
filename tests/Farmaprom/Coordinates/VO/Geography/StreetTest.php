<?php

namespace Farmaprom\Coordinates\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\Street;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class StreetTest
 * @package Farmaprom\Coordinates\Tests\VO\Geography
 */
class StreetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Street
     */
    private $street;

    public function setUp()
    {
        $this->street = new Street(new String("Test"), new String("22/12"));
    }

    public function testGetStreetName()
    {
        $this->assertSame("Test", $this->street->getName()->toNative());
    }

    public function testGetStreetNumber()
    {
        $this->assertSame("22/12", $this->street->getNumber()->toNative());
    }
}
