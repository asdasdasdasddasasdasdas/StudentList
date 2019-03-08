<?php

use StudentList\core\Router;


session_start();




require_once '../vendor/autoload.php';
require '../app/bootstrap.php';
$router = new Router($di);
$router->run();
