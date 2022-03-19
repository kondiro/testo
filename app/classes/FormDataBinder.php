<?php

namespace App\classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class FormDataBinder
{
    /**
     * Tree of bound targets.
     */
    private static $binding;


    public static function bind($bindings): void
    {
        self::$binding = $bindings;
    }


    public static function isCollection(): bool
    {
        return  self::$binding instanceof  Collection;
    }


    public static function get()
    {
        return self::$binding;
    }

    public static function end(): void
    {
        self::$binding = null;
    }


//    public static function bindExists(): bool
//    {
//        return isset(self::$binding);
//    }


}
