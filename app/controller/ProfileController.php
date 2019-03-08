<?php

namespace StudentList\controller;

<<<<<<< HEAD
use StudentList\model\Student;
use StudentList\controller\Controller;
=======
use StudentList\model\Student;
use StudentList\controller\Controller;
>>>>>>> 58933a70ff093df496cc5eaf0bf535562b7f7151

class ProfileController extends Controller
{
    private $model;
    private $auth;
    private $validator;

    public function __construct(
        \StudentList\model\StudentTableGateway $studentTG,
        \StudentList\helpers\StudentValidator $validator,
        \StudentList\helpers\Authorization $auth
    ) {
        $this->studentTG = $studentTG;
        $this->auth = $auth;
        $this->validator = $validator;
    }


    public function registration()
    {

        if (!$this->auth->IsLoggedIn()) {
            if (!empty($_POST)) {

                $student = new Student;
                $student->fill($this->grabPostValues());
                $errors = $this->validator->ValidateAll($student);
                if (empty($errors)) {
                    $student->generateHash();
                    $this->studentTG->addStudent($student);
                    $this->auth->makeAuth($student->hash);
                    header("Location:/profile");
                    die();
                }
            }

            $this->render('../app/view/registration/registration.php', [
                'errors' => $errors,
                'student' => $student
            ]);
        } else {
            header('Location:/');
            die();
        }
    }


    public function profile()
    {
        if ($this->auth->IsLoggedIn()) {

            $student = $this->auth->getAuthUser($this->auth->getHash());
            if (!empty($_POST)) {

                $student->fill($this->grabPostValues());
                $student->hash = $this->auth->getHash();
                $errors = $this->validator->ValidateAll($student);
                if (empty($errors)) {
                    $this->studentTG->updateStudent($student);
                    header("Location:/profile");
                    die();
                }
            }

            $this->render('../app/view/profile/profile.php', [
                'student' => $student,
                'errors' => $errors
            ]);
        } else {
            header("Location:/registration");
            die();
        }

    }


    private function grabPostValues(): array
    {
        $values = [];
        $values["name"] = array_key_exists("name", $_POST) ?
            trim(strval($_POST["name"])) :
            "";
        $values["surname"] = array_key_exists("surname", $_POST) ?
            trim(strval($_POST["surname"])) :
            "";
        $values["gender"] = array_key_exists("gender", $_POST) ?
            strval($_POST["gender"]) :
            "";
        $values["group_name"] = array_key_exists("group_name", $_POST) ?
            trim(strval($_POST["group_name"])) :
            "";
        $values["balli"] = array_key_exists("balli", $_POST) ?
            intval($_POST["balli"]) :
            0;
        $values["email"] = array_key_exists("email", $_POST) ?
            trim(strval($_POST["email"])) :
            "";

        return $values;
    }


}
