<?php

use RudePHP\Http\Request\Method;
use RudePHP\Http\Request\Request;
use RudePHP\Http\Routing\Route;
use RudePHP\Http\Routing\RoutePath;

class RouteTest extends PHPUnit_Framework_TestCase
{
    public function testMatches()
    {
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $path = new RoutePath('/foo/{id}');
        $route = new Route(Method::GET, $path, function() {});
        $this->assertTrue($route->matches($request));

        $request = new Request(['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/foo/bar']);
        $path = new RoutePath('/foo/bar');
        $route = new Route(Method::POST, $path, function() {});
        $this->assertTrue($route->matches($request));

        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $path = new RoutePath('/foo/bar');
        $route = new Route(Method::POST, $path, function() {});
        $this->assertFalse($route->matches($request));

        $request = new Request(['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/foo/bar']);
        $path = new RoutePath('/foo/{id}');
        $route = new Route(Method::POST, $path, function() {});
        $this->assertTrue($route->matches($request));

        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo']);
        $path = new RoutePath('/foo/bar');
        $route = new Route(Method::GET, $path, function() {});
        $this->assertFalse($route->matches($request));
    }

    public function testHandle()
    {
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/123']);
        $path = new RoutePath('/foo/{id}');
        $route = new Route(Method::GET, $path, function($id) {return $id;});
        $this->assertEquals('123', $route->handle($request));

        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/123/456']);
        $path = new RoutePath('/foo/{id}/{id2}');
        $route = new Route(Method::GET, $path, function($id, $id2) {return $id . $id2;});
        $this->assertEquals('123456', $route->handle($request));
    }
}