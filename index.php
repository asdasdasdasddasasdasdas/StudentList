<?php

declare(strict_types=1);
require 'app/config/debug.php';
use app\core\Router;
spl_autoload_register(function($class){
$path = str_replace('\\','/',$class.'.php');
if(file_exists($path)){
  require $path;
}
});
require 'app/bootstrap.php';
$router = new Router($di);
$router->run();
