<?php namespace RudePHP\Routing;

use RudePHP\Request\PathPart;

class RoutePathPart extends PathPart
{
    public function matches($requestUriPart)
    {
        if ($requestUriPart == $this->part || $this->isWildcard()) {
            return true;
        }

        return false;
    }

    public function isWildcard()
    {
        return (preg_match('/^{\w*}$/', $this->part) == true);
    }
}