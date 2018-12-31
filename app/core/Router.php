<?php
 namespace app\core;
use app\controller\ControllerFactory;
 class Router{

private $di;
public function __construct($DI){
$this->di =$DI;
}
public function run(){
$params = trim(
          parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH),"/"
          );
$params =explode('/',$params);


  if($params[0]){
    $controller = mb_strtolower($params[0]);
    if($params[1]){
      $action= mb_strtolower($params[1]).'Action';
    }
    else{

      $action = 'mainAction';
      $params[1]='main';
    }
  }
  else{
    $controller = 'main';
    $params[0]='main';
    $action = 'mainAction';
    $params[1]='main';
  }

 ControllerFactory::CreateController($controller,$this->di)->$action();



}

 }
