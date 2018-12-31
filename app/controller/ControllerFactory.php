<?php
namespace app\controller;
use app\controller\{MainController,RegistrationController,ProfileController};
class ControllerFactory
{

public static function CreateController($controller,$di)
{
  switch($controller)
  {
    case "main":
      $controllerObject = new MainController(
      $di->get('StudentTableGateway'),
      $di->get('Authorization'),
      $di->get('Paginator'));
    break;
    case "registration":
    $controllerObject = new RegistrationController(
      $di->get('StudentTableGateway'),
      $di->get('StudentValidator'),
      $di->get('Authorization'));

    break;
  case "profile":
  $controllerObject = new ProfileController(
    $di->get('StudentTableGateway'),
  $di->get('StudentValidator'),
$di->get('Authorization'));
  break;
  }

  return $controllerObject;
}
}
