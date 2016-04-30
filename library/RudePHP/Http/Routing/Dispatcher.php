<?php namespace RudePHP\Http\Routing;

use RudePHP\Http\Request\Request;

class Dispatcher
{
    /**
     * @var \RudePHP\Http\Routing\RouteStorage
     */
    private $routeStorage;

    /**
     * Dispatcher constructor.
     * @param \RudePHP\Http\Routing\RouteStorage $routeStorage
     */
    public function __construct(RouteStorage $routeStorage)
    {
        $this->routeStorage = $routeStorage;
    }

    /**
     * Sends Request to the correct Route
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return mixed
     * @throws \RudePHP\Exception\RouteNotFoundException
     */
    public function dispatch(Request $request)
    {
        $route = $this->routeStorage->find($request);
        return $route->handle($request);
    }
}