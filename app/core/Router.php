<?php

namespace StudentList\core;

use MainController;
use ProfileController;
use StudentList\exceptions\ControllerException;

class Router
{


    /**
     * @var \StudentList\helpers\DIContainer
     */
    private $di;
    /**
     * @var array
     */
    private $routes = [
        '/' => [
            'Controller' => MainController::class,
            'Action' => 'mainAction'
        ],
        '/profile' => [
            'Controller' => ProfileController::class,
            'Action' => 'profile'
        ],
        '/registration' => [
            'Controller' => ProfileController::class,
            'Action' => 'registration'
        ]
    ];


    /**
     * Router constructor.
     * @param \StudentList\helpers\DIContainer $di
     */
    public function __construct(\StudentList\helpers\DIContainer $di)
    {
        $this->di = $di;
    }

    /**
     *
     */
    public function run(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route => $val) {

            preg_match('~' . $uri . '~', $route, $match);

            if (!empty($match)) {
                $controller = $this->routes[$match[0]]['Controller'];
                $action = $this->routes[$match[0]]['Action'];
                break;

            } else {
                $controller = null;
            }
        }
        try {

            if ($controller !== null) {
                $this->di->get($controller)->__invoke()->$action();
            } else {
                throw new ControllerException;
            }
        } catch (ControllerException $e) {
            $e->get404($uri);
        }
    }
}
