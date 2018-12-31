<?php
use app\helpers\{DIContainer,StudentValidator,Authorization,Paginator};
use app\model\StudentTableGateway;
use app\controller\ControllerFactory;
use app\core\View;
$di = new DIContainer;

$di->bind('StudentTableGateway', new StudentTableGateway);

$di->bind('StudentValidator', new StudentValidator($di->get("StudentTableGateway")));

$di->bind('Paginator', new Paginator);

$di->bind('Authorization', new Authorization);
