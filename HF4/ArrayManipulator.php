<?php

/**
 * class ArrayManipulator
 */
class ArrayManipulator
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param $name
     * @return void
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }

    /**
     * @return void
     */
    public function __clone()
    {
        $this->data = array_map(function($item) {
            return is_object($item) ? clone $item : $item;
        }, $this->data);
    }

}