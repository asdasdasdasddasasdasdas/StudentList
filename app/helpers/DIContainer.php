<?php
namespace app\helpers;

class DIContainer
{
    /**
     * @var array
     */
    public $dependencies = [];
    /**
     * Binds dependency using $dependencies array
     *
     * @param string $key
     * @param $value
     */
    public function bind(string $name,$value) :void
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
     * @throws \Exception
     */
    public function get(string $name)
    {
        if (!array_key_exists($name, $this->dependencies))
        {
            throw new \Exception("No {$name} found in the container");
        }
        return $this->dependencies[$name];
    }
}
