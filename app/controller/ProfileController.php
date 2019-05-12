<?php

namespace StudentList\controller;

use StudentList\model\Student;

class ProfileController extends \StudentList\core\Controller
{
    /**
     * @var \StudentList\helpers\Util
     */
    private $util;

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

    /**
     * ProfileController constructor.
     * @param \StudentList\model\StudentTableGateway $studentTG
     * @param \StudentList\helpers\StudentValidator $validator
     * @param \StudentList\helpers\Authorization $auth
     * @param \StudentList\helpers\Util $util
     * @param \StudentList\helpers\CSRF $csrf
     */
    public function __construct(\StudentList\model\StudentTableGateway $studentTG,
                                \StudentList\helpers\StudentValidator $validator,
                                \StudentList\helpers\Authorization $auth,
                                \StudentList\helpers\Util $util,
                                \StudentList\helpers\CSRF $csrf)
    {
        $this->util = $util;
        $this->studentTG = $studentTG;
        $this->auth = $auth;
        $this->validator = $validator;
        $this->csrf = $csrf;
    }


    /**
     * @throws \Exception
     */
    public function registration(): void
    {

        if (!$this->auth->IsLoggedIn()) {
            $token = $this->csrf->makeToken();
            if (!empty($_POST)) {

                $student = new Student;


                $student->fill($this->grabStudentValues());
                $errors = $this->validator->ValidateAll($student, $this->csrf->checkToken());
                if (empty($errors)) {
                    $student->generateHash();
                    $this->studentTG->addStudent($student);
                    $this->auth->makeAuth($student->hash);
                    header("Location:/profile");
                    die();
                }
            }
            $this->render('../app/view/registration/registration.php', [
                'errors' => isset($errors) ? $errors : null,
                'student' => isset($student) ? $student : '',
                "token" => isset($token) ? $token : ''
            ]);
        } else {
            header('Location:/');
            die();
        }
    }

    /**
     * @return array
     */
    private function grabStudentValues(): array
    {
        $values = [];
        $values["name"] = $this->util->grabValue("name");
        $values["surname"] = $this->util->grabValue("surname");
        $values["gender"] = $this->util->grabValue("gender");
        $values["group_name"] = $this->util->grabValue("group_name");
        $values["balli"] = $this->util->grabValue("balli");
        $values["email"] = $this->util->grabValue("email");


        return $values;
    }

    /**
     *
     */
    public function profile(): void
    {
        if ($this->auth->IsLoggedIn()) {
            $token = $this->csrf->makeToken();
            $student = $this->auth->getAuthUser();
            if (!empty($_POST)) {

                $student->fill($this->grabStudentValues());
                $student->hash = $this->auth->getHash();
                $errors = $this->validator->validateAll($student, $this->csrf->checkToken());

                if (empty($errors)) {

                    $this->studentTG->updateStudent($student);
                    header("Location:/profile");
                    die();
                }
            }

            $this->render('../app/view/profile/profile.php', [
                'student' => isset($student) ? $student : null,
                'errors' => isset($errors) ? $errors : null,
                "token" => isset($token) ? $token : ''
            ]);
        } else {
            header("Location:/registration");
            die();
        }

    }
}
