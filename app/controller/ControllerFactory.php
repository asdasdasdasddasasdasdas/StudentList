<?php
namespace app\controller;

use app\controller\{MainController,RegistrationController,ProfileController};

class ControllerFactory
{

   public static function CreateController(string $controller,\app\helpers\DIContainer $di)
   {
       switch($controller)
       {
           case "MainController":
               $controllerObject = new MainController(
               $di->get(\StudentTableGateway::class),
               $di->get(\Authorization::class),
               $di->get(\Paginator::class)
               );
           break;
           case "RegistrationController":
               $controllerObject = new RegistrationController(
               $di->get(\StudentTableGateway::class),
               $di->get(\Authorization::class),
               $di->get(\StudentValidator::class)
               );

           break;
           case "ProfileController":
               $controllerObject = new ProfileController(
               $di->get(\StudentTableGateway::class),
               $di->get(\StudentValidator::class),
               $di->get(\Authorization::class)
               );
           break;
       }

       return $controllerObject;
   }
}
