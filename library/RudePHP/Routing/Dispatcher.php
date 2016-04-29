<?php namespace RudePHP\Routing;

use RudePHP\Exception\RouteNotFoundException;
use RudePHP\Request\Request;

class Dispatcher
{
    private $routeStorage;

    public function __construct(RouteStorage $routeStorage)
    {
        $this->routeStorage = $routeStorage;
    }

    public function dispatch(Request $request)
    {
        $route = $this->routeStorage->find($request);
        if ($route == null) {
            throw new RouteNotFoundException();
        }
        return $route->handle($request);
    }
}