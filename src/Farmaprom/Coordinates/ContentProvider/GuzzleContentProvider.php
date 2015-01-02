<?php

namespace Farmaprom\Coordinates\ContentProvider;

use Farmaprom\Coordinates\ContentProvider;
use Farmaprom\Coordinates\VO\String\String;
use Guzzle\Http\Client;

/**
 * Class GuzzleContentProvider
 * @package Farmaprom\Coordinates\ContentProvider
 */
final class GuzzleContentProvider implements ContentProvider
{
    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @param Client $guzzle
     */
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @param String $resource
     * @return string
     */
    public function fetch(String $resource)
    {
        return $this->guzzle->get($resource->toNative());
    }
}