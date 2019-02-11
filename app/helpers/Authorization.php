<?php

namespace app\Helpers;


class Authorization
{

    public function makeAuth($hash)
    {
        setcookie('hash', $hash, time() + 60 * 60 * 24 * 365 * 10, "/", null, false, true);
    }

    public function IsLoggedIn()
    {
        return isset($_COOKIE['hash']) ? true : false;
    }

    public function getHash()
    {
        return $_COOKIE['hash'];
    }


}
