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
              $student = $this->model->getStudentByHash($_COOKIE['hash']);
             if(!empty($_POST)){


           $student->fill($this->grabPostValues());
           $student->setHash($_COOKIE['hash']);
           $errors = $this->validator->ValidateAll($student);
           if(empty($errors)){
               $this->model->updateStudent($student);
               header("Location:/profile");die();
           }
         }

           $this->render('../public/view/profile/profile.php',[
           'student'=>$student,
           'errors'=>$errors
                 ]);
         } else{
             header("Location:/registration");die();
         }

     }



   private function grabPostValues()
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
       $values["groupa"] = array_key_exists("groupa", $_POST) ?
           trim(strval($_POST["groupa"])) :
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
