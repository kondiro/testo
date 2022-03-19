<?php

namespace App\services\Security;

use Cookie;

class RememberMeExpiration
{

    private static $data;
    private static $cookieName;
    public const MINUTES_EXPIRATION = 43200; //equivalent of 30 days


    /**
     * init cookie
     * @param $cookie_name
     * @param $data
     * @return RememberMeExpiration
     */
    public static function make($cookie_name, $data)
    {
        self::$cookieName = $cookie_name;
        self::$data = $data;
        return (new static);
    }


    /**
     * set cookie
     * @param int $minutes_expiration
     * @return RememberMeExpiration
     */
    public function setRememberMeExpiration(int $minutes_expiration = self::MINUTES_EXPIRATION): RememberMeExpiration
    {
        $this->cryptData();
        if (is_array(self::$data) && count(self::$data)) {
            Cookie::queue(self::$cookieName, serialize(self::$data), $minutes_expiration);
        }
        return $this;
    }

    /**
     * get cookie
     * @param $cookie_name
     * @return RememberMeExpiration
     */
    public static function getRememberMeCookie($cookie_name)
    {
        if (!empty($cookie_name) && Cookie::has($cookie_name)) {
            self::$cookieName = $cookie_name;
            self::$data = unserialize(Cookie::get($cookie_name));
            self::decrypt();
        }
        return self::$data;
    }

    /**
     * delete cookie
     * @param $cookie_name
     * @return RememberMeExpiration
     */
    public static function deleteRememberMeExpiration($cookie_name)
    {
        if (!empty($cookie_name) && Cookie::has($cookie_name)) {
            Cookie::queue(Cookie::forget($cookie_name));
        }
        return (new static);
    }


    /*
     * crypt data
     */
    private function cryptData()
    {
        if (is_array(self::$data) && count(self::$data)) {
            foreach (self::$data as $key => $val) {
                self::$data[$key] = \Crypt::encrypt($val);
            }
        }
    }

    /*
         * decrypt data
         */
    private static function decrypt()
    {
        if (!empty(self::$cookieName) && Cookie::has(self::$cookieName)) {
            if (is_array(self::$data) && count(self::$data)) {
                foreach (self::$data as $key => $val) {
                    self::$data[$key] = \Crypt::decrypt($val);
                }
            }
        }
    }
}
