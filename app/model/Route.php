<?php


namespace StudentList\model;


class Route
{
    private $controller;
    private $pattern;
    private $action;

    /**
     * Route constructor.
     * @param $controller
     * @param $pattern
     * @param $method
     * @param $action
     */
    public function __construct($controller, $pattern, $action)
    {
        $this->controller = $controller;
        $this->pattern = $pattern;
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

}