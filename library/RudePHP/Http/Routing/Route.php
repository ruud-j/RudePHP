<?php namespace RudePHP\Http\Routing;

use RudePHP\Http\Request\Request;

class Route
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var \RudePHP\Http\Routing\RoutePath
     */
    private $path;

    /**
     * @var callable
     */
    private $handler;

    /**
     * Route constructor.
     * @param string $method
     * @param \RudePHP\Http\Routing\RoutePath $path
     * @param callable $handler
     */
    public function __construct($method, RoutePath $path, callable $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * Executes registered handler for this Route
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $params = $this->path->getParams($request);
        return call_user_func_array($this->handler, $params);
    }

    /**
     * Checks if Request matches Route
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return bool
     */
    public function matches(Request $request)
    {
        if ($request->getMethod() == $this->method && $this->path->matches($request)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}