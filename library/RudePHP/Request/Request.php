<?php namespace RudePHP\Request;

class Request
{
    private $method;
    private $uri;
    private $path;

    public function __construct($server_variables)
    {
        $this->method = $server_variables['REQUEST_METHOD'];
        $this->uri = $server_variables['REQUEST_URI'];
        $this->path = new Path($this->uri);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getUriParts()
    {
        return $this->path->explode();
    }
}