<?php


namespace StudentList\helpers;


class Cookies
{

    /**
     * @param $name
     * @return mixed|string
     */
    public function getCookie($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';
    }

    /**
     * @param string $name
     * @param $value
     * @param int $time
     */
    public function setCookie(string $name, $value, int $time)
    {
        setcookie($name, $value, intval($time), "/", null, false,
            true);
    }

    /**
     * @param $name
     */
    public function deleteCookie($name)
    {
        unset($this->cookie[$name]);
    }

    /**
     * @param $name
     * @return bool
     */
    public function issetCookie($name)
    {
        return isset($_COOKIE[$name]) ? true : false;
    }
}