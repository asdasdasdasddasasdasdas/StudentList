<?php

use StudentList\helpers\DIContainer;
use StudentList\core\Router;

$di = new DIContainer;


$di->bind(CSRF::class, new StudentList\helpers\CSRF());

$di->bind('config', require 'config/config.php');

$di->bind(StudentTableGateway::class, new StudentList\model\StudentTableGateway($di->get('config')));

$di->bind(StudentValidator::class, new StudentList\helpers\StudentValidator($di->get(StudentTableGateway::class)));

$di->bind(Authorization::class, new StudentList\helpers\Authorization($di->get(StudentTableGateway::class)));
$di->bind(Router::class, new Router());



