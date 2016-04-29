<?php namespace RudePHP\Routing;

use RudePHP\Request\Request;
use RudePHP\Response\ErrorBasicResponse;

abstract class Router
{
    protected $routeStorage;
    protected $dispatcher;

    public abstract function start();

    public function __construct()
    {
        $this->routeStorage = new RouteStorage();
        $this->dispatcher = new Dispatcher($this->routeStorage);
    }

    public function dispatch()
    {
        $response = $this->dispatcher->dispatch(new Request($_SERVER));
        $response->show();
    }

    public function handleError(\Exception $e)
    {
        $response = new ErrorBasicResponse($e);
        $response->show();
    }

    protected function get($path, callable $handler) {
        $route = new Route('GET', new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }

    // TODO: Support for other request methods
}