<?php

use StudentList\core\Router;
use StudentList\core\App;

ini_set('display_errors', -1);
function d($n)
{
    echo "<pre class = d>";
    var_dump($n);
    echo "</pre>";
}

require_once '../vendor/autoload.php';
require '../app/bootstrap.php';


$router = $di->get(Router::class);
$router->addRoute("/", "mainAction", new \StudentList\controller\MainController(
    $di->get(\StudentTableGateway::class),
    $di->get(\Authorization::class)
));
$router->addRoute("/registration", "registrationAction", new \StudentList\controller\ProfileController(
    $di->get(\StudentTableGateway::class),
    $di->get(\StudentValidator::class),
    $di->get(\Authorization::class),
    $di->get(\CSRF::class)
));
$router->addRoute("/profile", "profileAction", new \StudentList\controller\ProfileController(
    $di->get(\StudentTableGateway::class),
    $di->get(\StudentValidator::class),
    $di->get(\Authorization::class),
    $di->get(\CSRF::class)
));

$request = \StudentList\http\Request::createFromGlobals($_SERVER);
$request = $request->withBody(new \StudentList\http\Stream(fopen('php://temp', 'w+')));


$response = new \StudentList\http\Response( new \StudentList\http\Stream(fopen('php://temp', 'w+')),200,$_SERVER);
$App = new App($router,$di);

$App->start($request,$response);
