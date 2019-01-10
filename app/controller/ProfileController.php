<?php
namespace app\controller;
use app\model\Student;
use app\controller\Controller;
class ProfileController extends Controller
{
private $model;
private $auth;
private $validator;
  public function __construct($model,$validator,$auth)
  {
    $this->model=$model;
    $this->auth=$auth;
    $this->validator=$validator;
  }

  public function mainAction()
  {


    if($this->auth->checkHash())
    {

$this->render('app/view/profile/profile.php',['student'=>$this->model->getStudentByHash($_COOKIE['hash']),'errors'=>$errors]);
}
     else
    {
      header("Location:/registration");die();
}

  }

  public function storeAction(){




   $student = new Student($this->getPostValues());
   $student->setHash($_COOKIE['hash']);
    $_SESSION['errors'] = $this->validator->ValidateAll($student);

         if(empty($_SESSION['errors']))
          {
           $this->model->updateStudent($student);
          }

          header("Location:/profile");die();
}
  private function getPostValues()
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
