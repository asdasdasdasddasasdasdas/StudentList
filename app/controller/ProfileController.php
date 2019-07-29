<?php

namespace StudentList\controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StudentList\core\View;
use StudentList\model\Student;

class ProfileController
{
    /**
     * @var \StudentList\model\StudentTableGateway
     */
    private $studentTG;
    /**
     * @var \StudentList\helpers\Authorization
     */
    protected $auth;
    /**
     * @var \StudentList\helpers\StudentValidator
     */
    private $validator;

    /**
     * @var \StudentList\helpers\CSRF
     */
    private $csrf;
    private $view;

    /**
     * ProfileController constructor.
     * @param \StudentList\model\StudentTableGateway $studentTG
     * @param \StudentList\helpers\StudentValidator $validator
     * @param \StudentList\helpers\Authorization $auth
     * @param \StudentList\helpers\CSRF $csrf
     */
    public function __construct(\StudentList\model\StudentTableGateway $studentTG,
                                \StudentList\helpers\StudentValidator $validator,
                                \StudentList\helpers\Authorization $auth,
                                \StudentList\helpers\CSRF $csrf)
    {

        $this->studentTG = $studentTG;
        $this->auth = $auth;
        $this->validator = $validator;
        $this->csrf = $csrf;
        $this->view = new View();
    }


      public function registrationAction(RequestInterface $request, ResponseInterface $response)
    {
        $hash = isset($request->getCookieParams()['hash']) ? $request->getCookieParams()['hash'] : '';


        if (!$this->auth->IsLoggedIn($hash)) {


            $cookieToken = $request->getCookieParams()['token'] != '' ? $request->getCookieParams()['token'] : null;

            $response = $this->csrf->makeToken($response, $cookieToken);

            $token = $this->csrf->getToken();

            $student = new Student;


            if (!empty($request->getParsedBody())) {

                $student->fill($request->getParsedBody());

                $errors = $this->validator->ValidateAll($student, $this->csrf->checkToken($request->getParsedBody()["token"], $cookieToken));

                if (empty($errors)) {

                    $student->generateHash();

                    $this->studentTG->addStudent($student);

                    $response = $this->auth->makeAuth($response, $student->getHash());

                    return $response->withHeader("location", "/profile");
                }
            }

            return $this->view->render('../app/view/registration/registration.php', $response, [
                'errors' => isset($errors) ? $errors : '',
                'student' => isset($student) ? $student : '',
                "token" => isset($token) ? $token : ''
            ]);
        } else {
            return $response->withHeader("location", "/profile");;

        }
    }

    /**
     *
     */
    public function profileAction(RequestInterface $request, ResponseInterface $response)
    {
       
        $hash = isset($request->getCookieParams()['hash']) ? $request->getCookieParams()['hash'] : '';

        if ($this->auth->IsLoggedIn($hash)) {

            $cookieToken = $request->getCookieParams()['token'] != '' ? $request->getCookieParams()['token'] : null;

            $response = $this->csrf->makeToken($response, $cookieToken);

            $token = $this->csrf->getToken();

            $student = $this->auth->getAuthUser($hash);

            if (!empty($request->getParsedBody())) {

                $student->fill($request->getParsedBody());

                $student->setHash($hash);

                $errors = $this->validator->validateAll($student, $this->csrf->checkToken($request->getParsedBody()["token"], $cookieToken));

                if (empty($errors)) {

                    $this->studentTG->updateStudent($student);

                   return $response->withHeader("location", "/profile");

                }
            }

            return $this->view->render('../app/view/profile/profile.php', $response, [
                'student' => isset($student) ? $student : '',
                'errors' => isset($errors) ? $errors : '',
                "token" => isset($token) ? $token : ''
            ]);
        } else {
            return $response->withHeader("location", "/registration");

        }

    }
}
