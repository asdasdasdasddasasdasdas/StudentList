<?php

use app\core\Router;


session_start();


spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', dirname(__FILE__) . "/../" . $class . '.php');

   

    if (file_exists($path)) {
        require $path;
    }
});

require '../app/bootstrap.php';
$router = new Router($di);
$router->run();
