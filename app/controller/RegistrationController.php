<?php
namespace app\controller;

use app\model\Student;
use app\controller\Controller;

class RegistrationController extends Controller
{
   protected $model;
   protected $validator;
   private $auth;
   public function __construct($model, $auth, $validator)
   {
       $this->model=$model;
       $this->validator=$validator;
       $this->auth = $auth;
   }

   public function mainAction()
   {
       if(!$this->auth->checkHash())
       {

           if(!empty($_POST))
           {

               $student = new Student;
               $student->fill($this->grabPostValues());
               $errors = $this->validator->ValidateAll($student);
               if(empty($errors)){
                   $student->generateHash();
                   $this->model->addStudent($student);
                   $this->auth->makeAuth($student->hash);
                   header("Location:/profile");die();
           }
           $this->render('../public/view/registration/registration.php',[
           'errors'=>$errors,'student'=>$student
           ]);
           
       }
  }


   public function grabPostValues()
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
