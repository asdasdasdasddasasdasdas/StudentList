<?php

namespace app\helpers;

class DIContainer
{
    /**
     * @var array
     */
    private $dependencies = [];

    /**
     * Binds dependency using $dependencies array
     *
     * @param string $key
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
     * @param string $key
     *
     * @return mixed
     *
     * @throws \DIContainerException
     */
    public function get(string $name)
    {
        try {
            if (!array_key_exists($name, $this->dependencies)) {
                throw new \app\exceptions\DIContainerException;
            }
        } catch (\app\exceptions\DIContainerException $e) {
            $e->getMessage2($name);
        }


        return $this->dependencies[$name];
    }
}
