<?php

namespace Farmaprom\Coordinates\Tests\Builder;

use Farmaprom\Coordinates\Builder\GoogleMapUrlBuilder;
use Farmaprom\Coordinates\VO\Geography\Address;
use Farmaprom\Coordinates\VO\Geography\Country;
use Farmaprom\Coordinates\VO\Geography\CountryCode;
use Farmaprom\Coordinates\VO\Geography\Street;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class GoogleMapUrlBuilderTest
 * @package Farmaprom\Coordinates\Tests\Builder
 */
class GoogleMapUrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildUrl()
    {
        $street = new Street(new String("Floriańska"), new String("15"));
        $country = new Country(new String(CountryCode::PL));
        $validAddress = new Address($street, new String("Krakow"), $country);

        $builder = new GoogleMapUrlBuilder(new String(GoogleMapUrlBuilder::GOOGLE_MAP_API));

        $this->assertSame(GoogleMapUrlBuilder::GOOGLE_MAP_API . "Floriańska+15,Krakow", $builder->buildUrl($validAddress));
    }
}
