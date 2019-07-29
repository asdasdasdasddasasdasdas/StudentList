<?php

namespace StudentList\helpers;

use Psr\Http\Message\ResponseInterface;
use StudentList\model\Student;
use StudentList\model\StudentTableGateway;

class Authorization
{

    /**
     * @var StudentTableGateway
     */
    private $studentTG;

    /**
     * Authorization constructor.
     * @param StudentTableGateway $studentTG
     */


    public function __construct(StudentTableGateway $studentTG)
    {
        $this->studentTG = $studentTG;

    }

    /**
     * @param $hash
     */
    public function makeAuth($response, $hash): ResponseInterface
    {
        $d = time();
        $response = $response->withHeader('Set-Cookie', "hash={$hash}; Max-Age={$d} + 60 * 60 * 24 * 30 * 12 * 10");        // Для идентификации пользователя.
        return $response;
    }

    /**
     * @return bool
     */
    public function IsLoggedIn($hash = ''): bool
    {
        if (isset($hash)) {
            return $this->studentTG->checkAuthUser($hash);
        } else {
            return false;
        }
    }

    /**
     * @return Student
     */
    public function getAuthUser($hash): Student// Получение текущего пользователя.
    {
        return $this->studentTG->getStudentByHash($hash);
    }
}
