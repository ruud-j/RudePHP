<?php namespace RudePHP\Request;

use RudePHP\Routing\RoutePathPart;

class Path
{
    const PATH_SEPERATOR = '/';

    protected $path;
    protected $parts = array();

    public function __construct($path)
    {
        $this->path = $path;
        $parts = $this->explode();
        foreach ($parts as $part) {
            $this->parts[] = new PathPart($part);
        }
    }

    public function explode()
    {
        $parts = explode(self::PATH_SEPERATOR, $this->path);
        return array_slice($parts, 1);
    }
}