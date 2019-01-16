<?php
namespace app\core;

use app\controller\ControllerFactory;

class Router
{

   private $di;
   public function __construct($DI)
   {
       $this->di =$DI;
   }
   public function run()
   {
       $params = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH),"/");
       $params =explode('/',$params);


       if($params[0]) {
           $controller = ucfirst($params[0]).'Controller';
           if($params[1]) {
               $action= mb_strtolower($params[1]).'Action';
           } else {
               $action = 'mainAction';
           }
       }
       else {
           $controller = 'MainController';
           $action = 'mainAction';
       }
   $controllerObject=ControllerFactory::CreateController($controller,$this->di);
   try {
       if(method_exists($controllerObject,$action)) {
           $controllerObject->$action();
       } else {
           throw new \Exception('Такой страницы не сущестует');
       }
   } catch (\Exception $e) {
       $e->getMessage();
   }


   }


}
