<?php

namespace StudentList\helpers;

class DIContainer
{
    /**
     * @var array
     */
    private $dependencies = [];


    /**
     * @param string $name
     * @param callable $func
     */
    public function bindFactory(string $name, callable $func)
    {
        $this->dependencies[$name] = $func;
    }

    /**
     * Binds dependency using $dependencies array
     *
     * @param string $name
     * @param $value
     */
    public function bind(string $name, $value): void
    {

        $this->dependencies[$name] = $value;
    }

    /**
     * Returns dependency from $dependencies array
     * Throws an exception if dependency is not found
     *
     * @param string $name
     *
     * @return mixed
     *
     * @throws \DIContainerException
     */
    public function get($name)
    {

        if (!array_key_exists($name, $this->dependencies)) {
            throw new \StudentList\exceptions\DIContainerException($name);
        }


        return $this->dependencies[$name];
    }
}
