<?php

namespace app\core;

use Closure;
use app\exceptions\ControllerException;

class Router
{

    private $di;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function run()
    {
        $url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $params = explode('/', $url);
        $action = mb_strtolower($params[0]);
        try {
            if (true) {
            }
            if ($action == 'profile') {
                $this->di->get(\ProfileController::class)->__invoke()->$action();
            } elseif ($action == 'registration') {
                $this->di->get(\ProfileController::class)->__invoke()->$action();
            } elseif ($action == '/' || $action == '') {
                $action = 'MainAction';
                $this->di->get(\MainController::class)->__invoke()->$action();
            } else {
                throw new ControllerException;
            }
        } catch (ControllerException $e) {
            $e->get404($url);
        }
    }
}
