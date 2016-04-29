<?php namespace RudePHP\Routing;

use RudePHP\Request\Request;

class RouteStorage
{
    private $routes = array();

    public function register(Route $route)
    {
        $this->routes[] = $route;
    }

    public function find(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request)) {
                return $route;
            }
        }
    }
}