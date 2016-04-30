<?php

use RudePHP\Http\Request\Method;
use RudePHP\Http\Request\Request;
use RudePHP\Http\Routing\Route;
use RudePHP\Http\Routing\RoutePath;
use RudePHP\Http\Routing\RouteStorage;

class RouteStorageTest extends PHPUnit_Framework_TestCase
{
    public function testFind()
    {
        $routeStorage = new RouteStorage();
        $route = new Route(Method::GET, new RoutePath('/foo/bar'), function() {return 1;});
        $routeStorage->register($route);
        $route = new Route(Method::GET, new RoutePath('/foo/{var}'), function() {return 2;});
        $routeStorage->register($route);
        $route = new Route(Method::GET, new RoutePath('/foo'), function() {return 3;});
        $routeStorage->register($route);
        $route = new Route(Method::GET, new RoutePath('/foo/not_reachable'), function() {return 4;});
        $routeStorage->register($route);
        $route = new Route(Method::GET, new RoutePath('/'), function() {return 5;});
        $routeStorage->register($route);
        $route = new Route(Method::POST, new RoutePath('/foo/bar'), function() {return 6;});
        $routeStorage->register($route);

        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(1, $routeStorage->find($request)->handle($request));
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/baz']);
        $this->assertEquals(2, $routeStorage->find($request)->handle($request));
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo']);
        $this->assertEquals(3, $routeStorage->find($request)->handle($request));
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/not_reachable']);
        $this->assertEquals(2, $routeStorage->find($request)->handle($request));
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/']);
        $this->assertEquals(5, $routeStorage->find($request)->handle($request));
        $request = new Request(['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(6, $routeStorage->find($request)->handle($request));
    }
}