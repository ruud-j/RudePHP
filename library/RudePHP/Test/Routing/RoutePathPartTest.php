<?php namespace RudePHP\Test\Routing;

use PHPUnit_Framework_TestCase;
use RudePHP\Routing\RoutePathPart;

class RoutePathPartTest extends PHPUnit_Framework_TestCase
{
    public function testIsWildcard()
    {
        $routePathPart = new RoutePathPart('{foo}');
        $this->assertTrue($routePathPart->isWildcard());

        $routePathPart = new RoutePathPart('{}');
        $this->assertTrue($routePathPart->isWildcard());

        $routePathPart = new RoutePathPart('foo');
        $this->assertFalse($routePathPart->isWildcard());

        $routePathPart = new RoutePathPart('{');
        $this->assertFalse($routePathPart->isWildcard());

        $routePathPart = new RoutePathPart('}');
        $this->assertFalse($routePathPart->isWildcard());

        $routePathPart = new RoutePathPart('}{');
        $this->assertFalse($routePathPart->isWildcard());
    }

    public function testMatches()
    {
        $routePathPart = new RoutePathPart('{foo}');
        $this->assertTrue($routePathPart->matches('bar'));

        $routePathPart = new RoutePathPart('foo');
        $this->assertTrue($routePathPart->matches('foo'));

        $routePathPart = new RoutePathPart('foo');
        $this->assertFalse($routePathPart->matches('bar'));
    }
}