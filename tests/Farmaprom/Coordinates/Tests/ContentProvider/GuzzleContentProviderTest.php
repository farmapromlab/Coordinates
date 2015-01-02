<?php

namespace Farmaprom\Coordinates\Tests\ContentProvider;

use Farmaprom\Coordinates\ContentProvider\GuzzleContentProvider;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class GuzzleContentProviderTest
 * @package Farmaprom\Coordinates\Tests\ContentProvider
 */
class GuzzleContentProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchIfResponseIsUnsuccessful()
    {
        $client = $this->getMock("Guzzle\\Http\\Client");

        $guzzleContentProvider = new GuzzleContentProvider($client);

        $this->assertNull($guzzleContentProvider->fetch(new String("http://google.com")));
    }

    public function testFetchIfResponseIsSuccessful()
    {
        $client = $this->getMock("Guzzle\\Http\\Client");

        $client->expects($this->once())
            ->method("get")
            ->with(new String("http://google.com"))
            ->will($this->returnValue("test_content"));

        $guzzleContentProvider = new GuzzleContentProvider($client);

        $this->assertSame("test_content", $guzzleContentProvider->fetch(new String("http://google.com")));
    }
}
