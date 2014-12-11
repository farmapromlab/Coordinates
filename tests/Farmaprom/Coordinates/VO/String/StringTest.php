<?php

namespace Farmaprom\Coordinates\Tests\VO\String;

use Farmaprom\Coordinates\VO\String\String;

/**
 * Class StringTest
 * @package Farmaprom\Coordinates\Tests\VO\String
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testToNative()
    {
        $string = new String("test");
        $this->assertSame("test", $string->toNative());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidNativeArgument()
    {
        new String(12);
    }

    public function testIsEmpty()
    {
        $string = new String("");
        $this->assertTrue($string->isEmpty());
    }
}
