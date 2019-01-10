<?php

namespace app\helpers;
use app\model\StudentTableGateway;
class StudentValidator {
private  $errors = [];
private $db;

public function __construct(StudentTableGateway $db)
{
  $this->db = $db;
}

public function ValidateAll($student)
{

  $this->errors['name_error']=$this->ValidateName($student->name);
  $this->errors['surname_error']=$this->ValidateSurname($student->surname);
  $this->errors['group_error']=$this->ValidateGroup($student->group);
  $this->errors['gender_error']=$this->ValidateGender($student->female,$student->male);
  $this->errors['balli_error']=$this->ValidateBalli($student->balli);
  $this->errors['email_error']=$this->ValidateEmail($student->email);
  return array_filter($this->errors, function($value) {
         return $value !== null;
     });
}
public function ValidateName( $name)
{

  $length = mb_strlen($name);
  if($length>40){
    return "Длина Имени не должна превышать 40 символов, а вы ввели {$length}";
  }
  elseif($length==0){
    return "Вы не ввели имя";
  }
}

private function ValidateSurname($surname)
{
  $length = mb_strlen($surname);
  if($length>40){
    return "Длина фамилии не должна превышать 40 символов, а вы ввели {$length}";
  }
  elseif($length==0){
    return "Вы не ввели Фамилию";
  }
}
private function ValidateBalli( $balli)
{
  if($balli>300 || $balli<50){
    return "Количество баллов должно находится в пределе от 50 до 300, а вы ввели $balli";

}
if($balli===0){
  return "вы не ввели количество баллов";

}
}
private function ValidateEmail( $email)
{
 $length = mb_strlen($email);
  if($length==0){
    return "Вы не ввели почту";
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return "E-mail должен быть в формате \"asdasd@domain.com\".";
        }
  elseif($this->db->CheckEmail($email)){
    return "Такой E-mail уже сущестует";
  }
}
private function ValidateGroup($group)
{
  $length =mb_strlen($group);

if($length == 0){
return "Вы не ввели группу";
}
elseif($length < 2 || $length >5){
  return "Вы ввели недопустимое количество символов. Должно быть в пределе от 2 до 5, а вы ввели {$length}";
}
elseif(!preg_match("/^[а-яёА-ЯЁ0-9]+$/u",$group)){
  return "Номер группы может содержать только русские буквы и цифры";
}
}
private function ValidateGender($female,$male){
  if($female == 0 && $male ==0){
    return "Вы не ввели свой пол";
  }
}
}
