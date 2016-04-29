<?php namespace RudePHP\Request;

class PathPart
{
    protected $part;

    public function __construct($part)
    {
        $this->part = $part;
    }
}