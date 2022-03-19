<?php

namespace App\services;

/*
 * array functions  helpers
 */


class Arrays
{

    public static function trimArrayKeys($array)
    {
        if (is_array($array) && count($array)) {
            foreach ($array as $key => $val) {
                if (str_contains($key, ' ')) {
                    $new_key = trim($key);
                    $array[$new_key] = $val;
                    unset($array[$key]);
                }
            }
            return $array;
        }

    }


    public static function trimArray($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            $array[$i] = trim($array[$i]);
        }
        return $array;
    }

}
