<?php

namespace Farmaprom\Coordinates\VO\String;

/**
 * Class String
 * @package Farmaprom\Coordinates\VO\String
 */
final class String
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_string($value) === false) {
            throw new \InvalidArgumentException;
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return \strlen($this->value) == 0;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
