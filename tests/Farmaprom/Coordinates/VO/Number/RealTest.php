<?php

namespace Farmaprom\Coordinates\Tests\VO\Number;

use Farmaprom\Coordinates\Vo\Number\Real;

/**
 * Class RealTest
 * @package Farmaprom\Coordinates\Tests\VO\Number
 */
class RealTest extends \PHPUnit_Framework_TestCase
{
    public function testToNative()
    {
        $real = new Real(12.34);
        $this->assertSame(12.34, $real->toNative());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidNativeArgument()
    {
        new Real("test");
    }
}
