<?php namespace RudePHP\Controller;

use RudePHP\Exception\ControllerFunctionNotFoundException;

class BaseController
{
    /**
     * Instantiate controller and call method with params
     *
     * @param string $method
     * @return mixed
     * @throws \RudePHP\Exception\ControllerFunctionNotFoundException
     */
    public static function call($method)
    {
        $controller = new static();
        $arguments = func_get_args();
        $arguments = array_splice($arguments, 1);
        if (method_exists($controller, $method)) {
            return call_user_func_array(array($controller, $method), $arguments);
        } else {
            throw new ControllerFunctionNotFoundException();
        }
    }
}