<?php
use app\helpers\DIContainer;

$di = new DIContainer;

$di->bind('dbconfig',[
   'host'=>'localhost',
   'name'=>'users',
   'user'=>'root',
   'password'=>''
   ]);

$di->bind(StudentTableGateway::class, new app\model\StudentTableGateway($di->get('dbconfig')));

$di->bind(StudentValidator::class, new app\helpers\StudentValidator($di->get(StudentTableGateway::class)));

$di->bind(Paginator::class, new app\helpers\Paginator);

$di->bind(Authorization::class, new app\helpers\Authorization);
