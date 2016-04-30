<?php namespace RudePHP\Http\Routing;

use RudePHP\Http\Path;
use RudePHP\Http\Request\Request;

class RoutePath extends Path
{
    /**
     * Array of RoutePathParts
     *
     * @var array
     */
    protected $parts = array();

    /**
     * RoutePath constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        parent::__construct($path);
        
        $parts = $this->explode();
        foreach ($parts as $part) {
            $this->parts[] = new RoutePathPart($part);
        }
    }

    /**
     * Checks if Request matches the RoutePath
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return bool
     */
    public function matches(Request $request)
    {
        $requestUriParts = $request->getUriParts();

        // Paths need to be of the same part count to match
        if (count($requestUriParts) != count($this->parts)) {
            return false;
        }

        // Test for all uri parts for matching route parts
        for ($i = 0; $i < count($this->parts); $i++) {
            $requestUriPart = $requestUriParts[$i];
            if (!$this->parts[$i]->matches($requestUriPart)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Extract params from request according to the wildcards in the route path
     *
     * @param \RudePHP\Http\Request\Request $request
     * @return array
     */
    public function getParams(Request $request)
    {
        $params = array();
        $requestUriParts = $request->getUriParts();
        
        for ($i = 0; $i < count($this->parts); $i++) {
            if ($this->parts[$i]->isWildcard()) {
                $params[] = $requestUriParts[$i];
            }
        }

        return $params;
    }
}