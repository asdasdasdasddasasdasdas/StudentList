<?php

namespace StudentList\helpers;

use StudentList\exceptions\DIContainerException;

class DIContainer
{
    /**
     * @var array
     */
    private $dependencies = [];

    /**
     *
     *
     * @param string $name
     * @param $value
     */
    public function bind(string $name, $value): void
    {

        $this->dependencies[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->dependencies[$name];
    }
}
