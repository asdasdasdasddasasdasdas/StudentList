<?php
namespace app\model;

class Student {
  public $name;
  public $surname;
  public $group;
  public $male;
  public $female;
  public $hash;
  public $balli;
  public $email;
  public function __construct($post=[]){
$this->name = $post['name'];
$this->surname = $post['surname'];
$this->balli = $post['balli'];
$this->group = $post['group'];
$this->email = $post['email'];
if($post['gender']=='male'){
  $this->male=1;
  $this->female=0;
}
elseif($post['gender']=='female'){
  $this->female=1;
  $this->male=0;
}
  }
  public function generateHash(){
   $this->hash = bin2hex(random_bytes(32));
}

public function setHash($hash){
  $this->hash = $hash;
}
}
