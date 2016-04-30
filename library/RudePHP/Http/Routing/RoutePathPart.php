<?php namespace RudePHP\Http\Routing;

use RudePHP\Http\PathPart;

class RoutePathPart extends PathPart
{
    /**
     * Checks if uri part matches to RoutePathPart
     *
     * @param string $requestUriPart
     * @return bool
     */
    public function matches($requestUriPart)
    {
        if ($requestUriPart == $this->part || $this->isWildcard()) {
            return true;
        }

        return false;
    }

    /**
     * Checks if this RoutePathPart is a wildcard
     * Wildcards are anything between curly braces
     *
     * @return bool
     */
    public function isWildcard()
    {
        return (preg_match('/^{\w*}$/', $this->part) == true);
    }
}