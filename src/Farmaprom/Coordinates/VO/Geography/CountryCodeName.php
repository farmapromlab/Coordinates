<?php

namespace Farmaprom\Coordinates\VO\Geography;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Farmaprom\Coordinates\VO\String\String;

/**
 * Class CountryCodeName
 * @package Farmaprom\Coordinates\VO\Geography
 */
final class CountryCodeName
{
    private static $names = [
        'PL' => 'Poland',
        'EN' => 'England',
        'DE' => 'Germany',
        'FR' => 'France',
    ];

    /**
     * @param String $code
     * @return String
     */
    public static function getName(String $code)
    {
        if (!isset(self::$names[$code->toNative()])) {
            throw new InvalidArgumentException;
        }

        $name      = self::$names[$code->toNative()];
        return new String($name);
    }
}
