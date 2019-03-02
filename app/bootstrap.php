<?php

use app\helpers\DIContainer;

$di = new DIContainer;

$di->bind(StudentTableGateway::class, new app\model\StudentTableGateway());

$di->bind(StudentValidator::class, new app\helpers\StudentValidator($di->get(StudentTableGateway::class)));

$di->bind(Authorization::class, new app\helpers\Authorization($di->get(StudentTableGateway::class)));

$di->bind(MainController::class, function () use ($di) {

    return new \app\controller\MainController(
        $di->get(\StudentTableGateway::class),
        $di->get(\Authorization::class)
    );
});

$di->bind(ProfileController::class, function () use ($di) {
    return new \app\controller\ProfileController(
        $di->get(\StudentTableGateway::class),
        $di->get(\StudentValidator::class),
        $di->get(\Authorization::class)
    );
});
