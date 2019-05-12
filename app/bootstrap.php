<?php

use StudentList\helpers\DIContainer;

$di = new DIContainer;

$di->bind(Cookie::class, new StudentList\helpers\Cookie);

$di->bind(CSRF::class, new StudentList\helpers\CSRF($di->get(Cookie::class)));
$di->bind('config', require 'config/config.php');

$di->bind(Util::class, new StudentList\helpers\Util);

$di->bind(StudentTableGateway::class, new StudentList\model\StudentTableGateway($di->get('config')));

$di->bind(StudentValidator::class, new StudentList\helpers\StudentValidator($di->get(StudentTableGateway::class)));

$di->bind(Authorization::class, new StudentList\helpers\Authorization($di->get(StudentTableGateway::class),
    $di->get(Cookie::class)));

$di->bindFactory(MainController::class, function () use ($di) {

    return new \StudentList\controller\MainController(
        $di->get(\StudentTableGateway::class),
        $di->get(\Authorization::class)
    );
});

$di->bindFactory(ProfileController::class, function () use ($di) {
    return new \StudentList\controller\ProfileController(
        $di->get(\StudentTableGateway::class),
        $di->get(\StudentValidator::class),
        $di->get(\Authorization::class),
        $di->get(\Util::class),
        $di->get(\CSRF::class)
    );
});
