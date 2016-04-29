<?php namespace RudePHP\Routing;

use RudePHP\Request\Path;
use RudePHP\Request\Request;

class RoutePath extends Path
{
    public function __construct($path)
    {
        $this->path = $path;
        $parts = $this->explode();
        foreach ($parts as $part) {
            $this->parts[] = new RoutePathPart($part);
        }
    }

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