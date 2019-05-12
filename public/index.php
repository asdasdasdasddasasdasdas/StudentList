<?php
error_reporting(-1);

use StudentList\core\Router;


require_once '../vendor/autoload.php';
require '../app/bootstrap.php';
$router = new Router($di);
$router->run();
