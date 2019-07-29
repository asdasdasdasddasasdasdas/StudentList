<?php

namespace StudentList\core;

use MainController;
use ProfileController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StudentList\exceptions\ControllerException;
use StudentList\model\Route;

class Router
{
    /**
     * @var array
     */
    private $routes = [];


    public function addRoute(string $pattern, string $action, $controller)
    {
        $this->routes[] = new Route($controller, $pattern, $action);
    }

    /**
     * @param $uri
     * @return null
     */
    public function getController($uri)
    {

        foreach ($this->routes as $route) {

            preg_match('~' . $uri . '~', $route->getPattern(), $match);

            if ($match) {

                return $route;
            }
        }
        return null;

    }

    /**
     *
     */

    public function run(RequestInterface $request, ResponseInterface $response)
    {


        $match = $this->getController($request->getRequestTarget());

        if (!empty($match)) {

            $controller = $match->getController();
            $action = $match->getAction();


        } else {
            $controller = null;

        }
        if ($controller !== null && method_exists($controller, $action)) {
            return $controller->$action($request, $response);
        } else {
            throw new ControllerException(404);
        }

    }
}
