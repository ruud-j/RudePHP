<?php namespace RudePHP\Http\Routing;

use RudePHP\Http\Request\Method;
use RudePHP\Http\Request\Request;
use RudePHP\Http\Response\ErrorResponse;

abstract class Router
{
    /**
     * @var \RudePHP\Http\Routing\RouteStorage
     */
    protected $routeStorage;

    /**
     * @var \RudePHP\Http\Routing\Dispatcher
     */
    protected $dispatcher;

    /**
     * Base function for registering all routes
     *
     * @return void
     */
    public abstract function start();

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routeStorage = new RouteStorage();
        $this->dispatcher = new Dispatcher($this->routeStorage);
    }

    /**
     * Create and dispatch the Request, then show the Response
     *
     * @throws \RudePHP\Exception\RouteNotFoundException
     */
    public function dispatch()
    {
        $response = $this->dispatcher->dispatch(new Request($_SERVER));
        $response->show();
    }

    /**
     * Display a nice error page for Exception
     *
     * @param \Exception $e
     */
    public function handleError(\Exception $e)
    {
        $response = new ErrorResponse($e);
        $response->show();
    }

    /**
     * Register a GET Route in RouteStorage
     *
     * @param string $path
     * @param callable $handler
     */
    protected function get($path, callable $handler) {
        $route = new Route(Method::GET, new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }

    /**
     * * Register a POST Route in RouteStorage
     *
     * @param string $path
     * @param callable $handler
     */
    protected function post($path, callable $handler) {
        $route = new Route(Method::POST, new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }

    /**
     * * Register a PUT Route in RouteStorage
     *
     * @param string $path
     * @param callable $handler
     */
    protected function put($path, callable $handler) {
        $route = new Route(Method::PUT, new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }

    /**
     * * Register a PATCH Route in RouteStorage
     *
     * @param string $path
     * @param callable $handler
     */
    protected function patch($path, callable $handler) {
        $route = new Route(Method::PATCH, new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }

    /**
     * * Register a DELETE Route in RouteStorage
     *
     * @param string $path
     * @param callable $handler
     */
    protected function delete($path, callable $handler) {
        $route = new Route(Method::DELETE, new RoutePath($path), $handler);
        $this->routeStorage->register($route);
    }
}