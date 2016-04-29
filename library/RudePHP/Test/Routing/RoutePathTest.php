<?php namespace RudePHP\Test\Routing;

use PHPUnit_Framework_TestCase;
use RudePHP\Request\Request;
use RudePHP\Routing\RoutePath;

class RoutePathTest extends PHPUnit_Framework_TestCase
{
    public function testMatches()
    {
        $routePath = new RoutePath('/foo');
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo']);
        $this->assertTrue($routePath->matches($request));
    }
}