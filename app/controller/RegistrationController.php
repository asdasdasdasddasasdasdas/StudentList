<?php
namespace app\controller;
use app\model\Student;
use app\controller\Controller;
class RegistrationController extends Controller{
protected $model;
protected $validator;
public $auth;
  public function __construct($model, $validator, $auth)
  {
$this->model=$model;
$this->validator=$validator;
$this->auth = $auth;


  }

public function mainAction()
{


if(!$this->auth->checkHash()){

  $post = $this->grabPostValues();

  $student = new Student($post);

if (isset($_POST['submit'])) {
  $errors = $this->validator->ValidateAll($student);
if($errors['name_error']==null and $errors['surname_error']==null and $errors['group_error']==null and $errors['gender_error']==null and
 $errors['balli_error']==null and $errors['email_error']==null){
  $student->generateHash();
  $this->model->addStudent($student);
  $this->auth->Cookie($student->hash);
  header("Location:http://test.com/profile");die();

}
}
}
else{
    header("Location:http://test.com/profile");die();
}
$this->render('app/view/registration/registration.php',['errors'=>$errors]);
}


private function grabPostValues()
{
    $values = [];
    $values["name"] = array_key_exists("name", $_POST) ?
        strval(trim($_POST["name"])) :
        "";
    $values["surname"] = array_key_exists("surname", $_POST) ?
        strval(trim($_POST["surname"])) :
        "";
    $values["gender"] = array_key_exists("gender", $_POST) ?
        strval($_POST["gender"]) :
        "";
    $values["group"] = array_key_exists("group", $_POST) ?
        strval(trim($_POST["group"])) :
        "";
    $values["balli"] = array_key_exists("balli", $_POST) ?
        intval($_POST["balli"]) :
        0;
    $values["email"] = array_key_exists("email", $_POST) ?
        strval(trim($_POST["email"])) :
        "";

    return $values;
}

}
