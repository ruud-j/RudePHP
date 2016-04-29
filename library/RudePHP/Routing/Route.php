<?php namespace RudePHP\Routing;

use RudePHP\Request\Request;

class Route
{
    private $method;
    private $path;
    private $handler;

    public function __construct($method, RoutePath $path, callable $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    public function handle(Request $request)
    {
        $params = $this->path->getParams($request);
        return call_user_func_array($this->handler, $params);
    }

    public function matches(Request $request)
    {
        if ($request->getMethod() == $this->method && $this->path->matches($request)) {
            return true;
        } else {
            return false;
        }
    }
}