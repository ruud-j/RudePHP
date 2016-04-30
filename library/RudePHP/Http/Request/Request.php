<?php namespace RudePHP\Http\Request;

class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var \RudePHP\Http\Path
     */
    private $path;

    /**
     * Request constructor.
     * @param array $server_variables
     */
    public function __construct($server_variables)
    {
        $this->method = $server_variables['REQUEST_METHOD'];
        $this->uri = $server_variables['REQUEST_URI'];
        $this->path = new Path($this->uri);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get seperate parts form request URI
     *
     * @return array
     */
    public function getUriParts()
    {
        return $this->path->explode();
    }
}