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
        try {

            if (!array_key_exists($name, $this->dependencies)) {
                throw new DIContainerException(503, 'Service Unavailable');
            }

        } catch(DIContainerException $e) {
        echo 'Error: ' . $e->getCode(). ' ' . $e->getMessage(); die();
        }
        return $this->dependencies[$name];
    }
}
