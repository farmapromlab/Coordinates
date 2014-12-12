<?php

namespace Farmaprom\Coordinates\Tests\Stub;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\RequestInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class Client
 * @package Farmaprom\Coordinates\Stub
 */
class Client implements ClientInterface
{

    public function setConfig($config)
    {
    }

    public function getConfig($key = false)
    {
    }

    public function createRequest(
        $method = RequestInterface::GET,
        $uri = null,
        $headers = null,
        $body = null,
        array $options = array()
    )
    {
    }

    public function get($uri = null, $headers = null, $options = array())
    {
    }

    public function head($uri = null, $headers = null, array $options = array())
    {
    }

    public function delete($uri = null, $headers = null, $body = null, array $options = array())
    {
    }

    public function put($uri = null, $headers = null, $body = null, array $options = array())
    {
    }

    public function patch($uri = null, $headers = null, $body = null, array $options = array())
    {
    }

    public function post($uri = null, $headers = null, $postBody = null, array $options = array())
    {
    }

    public function options($uri = null, array $options = array())
    {
    }

    public function send($requests)
    {
    }

    public function getBaseUrl($expand = true)
    {
    }

    public function setBaseUrl($url)
    {
    }

    public function setUserAgent($userAgent, $includeDefault = false)
    {
    }

    public function setSslVerification($certificateAuthority = true, $verifyPeer = true, $verifyHost = 2)
    {
    }

    public static function getAllEvents()
    {
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
    }

    public function getEventDispatcher()
    {
    }

    public function dispatch($eventName, array $context = array())
    {
    }

    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
    }
}
