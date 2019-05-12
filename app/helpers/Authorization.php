<?php

namespace StudentList\helpers;

use StudentList\model\Student;

class Authorization
{
    /**
     * @var
     */
    private $studentTG;
    private $cookie;

    /**
     * Authorization constructor.
     * @param $studentTG
     * @param $cookie
     */
    public function __construct($studentTG, $cookie)
    {
        $this->studentTG = $studentTG;
        $this->cookie = $cookie;
    }

    /**
     * Authorization constructor.
     * @param $studentTG
     */


    /**
     * @param $hash
     */
    public function makeAuth($hash): void
    {
        $this->cookie->setCookie('hash', $hash, time() + 60 * 60 * 24 * 30 * 12 * 10);// Для идентификации пользователя.
    }

    /**
     * @return bool
     */
    public function IsLoggedIn(): bool
    {
        return $this->studentTG->checkAuthUser($this->getHash());
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->cookie->getCookie('hash');
    }

    /**
     * @return Student
     */
    public function getAuthUser(): Student// Получение текущего пользователя.
    {
        return $this->studentTG->getStudentByHash($this->getHash());
    }
}
