<?php

namespace StudentList\helpers;

use StudentList\model\Student;
use StudentList\model\StudentTableGateway;

class Authorization
{

    /**
     * @var StudentTableGateway
     */
    private $studentTG;
    /**
     * @var Cookies
     */
    private $cookies;

    /**
     * Authorization constructor.
     * @param StudentTableGateway $studentTG
     */
    public function __construct(StudentTableGateway $studentTG, Cookies $cookies)
    {
        $this->studentTG = $studentTG;
        $this->cookies = $cookies;
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
        $this->cookies->setCookie('hash', $hash, time() + 60 * 60 * 24 * 30 * 12 * 10);// Для идентификации пользователя.
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
    public function getHash()
    {
        return $this->cookies->getCookie('hash');
    }

    /**
     * @return Student
     */
    public function getAuthUser(): Student// Получение текущего пользователя.
    {
        return $this->studentTG->getStudentByHash($this->getHash());
    }
}
