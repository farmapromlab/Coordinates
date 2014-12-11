<?php

namespace Farmaprom\Coordinates\Vo\Number;

/**
 * Class Real
 * @package Farmaprom\Coordinates\Vo\Number
 */
class Real
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @param float $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        $value = \filter_var($value, FILTER_VALIDATE_FLOAT);
        if (false === $value) {
            throw new \InvalidArgumentException;
        }
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return \strval($this->toNative());
    }
}
