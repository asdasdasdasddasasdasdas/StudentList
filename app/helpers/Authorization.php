<?php

namespace app\Helpers;


class Authorization
{
    private $studentTG;


    public function __construct($studentTG)
    {
        $this->studentTG = $studentTG;
    }

    public function makeAuth($hash)
    {
        setcookie('hash', $hash, time() + 60 * 60 * 24 * 365 * 10, "/", null, false,
            true); // Для идентификации пользователя.
    }

    public function IsLoggedIn()
    {
        return isset($_COOKIE['hash']) ? true : false;
    }

    public function getHash()
    {
        return $_COOKIE['hash'];
    }

    public function getAuthUser($hash) // Получение текущего пользователя.
    {
        return $this->studentTG->getStudentByHash($hash);
    }


}
