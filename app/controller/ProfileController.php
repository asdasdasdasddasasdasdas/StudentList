<?php

namespace StudentList\controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StudentList\core\View;
use StudentList\model\Student;

class ProfileController extends \StudentList\core\Controller
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


    /**
     * @throws \Exception
     */
    public function registrationAction(RequestInterface $request,ResponseInterface $response)
    {

        if (!$this->auth->IsLoggedIn()) {
            $token = $this->csrf->makeToken();
            $student = new Student;
            if (!empty($request->getParsedBody())) {
                $student->fill($request->getParsedBody());
                $errors = $this->validator->ValidateAll($student, $this->csrf->checkToken($request->getParsedBody()["token"]));
                if (empty($errors)) {
                    $student->generateHash();
                    $this->studentTG->addStudent($student);
                    $this->auth->makeAuth($student->getHash());
                    return $response->withHeader("location","/profile");
                }
            }

           return $this->view->render('../app/view/registration/registration.php', $response, [
                'errors' => isset($errors) ? $errors : '',
                'student' => isset($student) ? $student : '',
                "token" => isset($token) ? $token : ''
            ]);
        } else {
           return $response->withHeader("location","/profile");;

        }
    }

    /**
     *
     */
    public function profileAction(RequestInterface $request,ResponseInterface $response)
    {
        if ($this->auth->IsLoggedIn()) {

            $token = $this->csrf->makeToken();
            $student = $this->auth->getAuthUser();
            if (!empty($request->getParsedBody())) {
                $student->fill($request->getParsedBody());
                $student->setHash($this->auth->getHash());
                $errors = $this->validator->validateAll($student, $this->csrf->checkToken($request->getParsedBody()["token"]));

                if (empty($errors)) {
                    $this->studentTG->updateStudent($student);

                    $response->withHeader("location","/profile");
                }
            }

           return $this->view->render('../app/view/profile/profile.php', $response, [
                'student' => isset($student) ? $student : '',
                'errors' => isset($errors) ? $errors : '',
                "token" => isset($token) ? $token : ''
            ]);
        } else {
            return $response->withHeader("location","/registration");

        }

    }
}
