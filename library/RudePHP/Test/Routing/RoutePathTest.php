<?php

use RudePHP\Http\Request\Request;
use RudePHP\Http\Routing\RoutePath;

class RoutePathTest extends PHPUnit_Framework_TestCase
{
    public function testGetParams()
    {
        $routePath = new RoutePath('/{first}/{second}');
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(array('foo', 'bar'), $routePath->getParams($request));

        $routePath = new RoutePath('/foo/{first}');
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(array('bar'), $routePath->getParams($request));

        $routePath = new RoutePath('/foo/{first}/bar/{second}');
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar/baz/qux']);
        $this->assertEquals(array('bar', 'qux'), $routePath->getParams($request));
    }
}