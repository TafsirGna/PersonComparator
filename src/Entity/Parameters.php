<?php

namespace App\Entity;

class Parameters
{

    /**
     * @var array
     */
    private $delimiters = [];

    /**
     * @var array
     */
    public static $weights = [
        "firstName" =>  3,
        "lastName"  =>  4,
        "birthDate" =>  1,
        "birthPlace"    =>  1,
        "spouseLastName"    => 1
    ];

    /**
     * @var array
     */
    public static $spouseKeyWords = [
        "epse",
        "épse",
        "epouse",
        "épouse"
    ];

    /**
     * @var double
     */
    public static $stringPropertyThreshold = 0.2;
    
    /**
     * @var double
     */
    public static $globalThreshold = 0.7;
}
