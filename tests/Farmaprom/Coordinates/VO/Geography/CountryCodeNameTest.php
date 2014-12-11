<?php

namespace Farmaprom\Tests\VO\Geography;

use Farmaprom\Coordinates\VO\Geography\CountryCode;
use Farmaprom\Coordinates\VO\Geography\CountryCodeName;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class CountryCodeNameTest
 * @package Farmaprom\Tests\VO\Geography
 */
class CountryCodeNameTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertSame(CountryCodeName::getName(new String(CountryCode::PL))->toNative(), "Poland");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetNameWithIncorrectCode()
    {
        $this->assertSame(CountryCodeName::getName(new String("KU"))->toNative(), "Poland");
    }
}
