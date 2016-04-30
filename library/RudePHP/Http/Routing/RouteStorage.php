<?php namespace RudePHP\Http\Routing;

use RudePHP\Exception\RouteNotFoundException;
use RudePHP\Http\Request\Request;

/**
 * Class RouteStorage
 * @package RudePHP\Http\Routing
 */
class RouteStorage
{
    /**
     * @var array
     */
    private $routes = array();

    /**
     * Stores Route
     *
     * @param \RudePHP\Http\Routing\Route $route
     */
    public function register(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * Finds Route for Request
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return \RudePHP\Http\Routing\Route
     * @throws RouteNotFoundException
     */
    public function find(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request)) {
                return $route;
            }
        }

        throw new RouteNotFoundException();
    }
}