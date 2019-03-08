<?php

use StudentList\helpers\DIContainer;

$di = new DIContainer;

$di->bind(StudentTableGateway::class, new StudentList\model\StudentTableGateway());

$di->bind(StudentValidator::class, new StudentList\helpers\StudentValidator($di->get(StudentTableGateway::class)));

$di->bind(Authorization::class, new StudentList\helpers\Authorization($di->get(StudentTableGateway::class)));

$di->bind(MainController::class, function () use ($di) {

    return new \StudentList\controller\MainController(
        $di->get(\StudentTableGateway::class),
        $di->get(\Authorization::class)
    );
});

$di->bind(ProfileController::class, function () use ($di) {
    return new \StudentList\controller\ProfileController(
        $di->get(\StudentTableGateway::class),
        $di->get(\StudentValidator::class),
        $di->get(\Authorization::class)
    );
});
