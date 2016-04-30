<?php namespace RudePHP\Http;

abstract class PathPart
{
    /**
     * @var string
     */
    protected $part;

    /**
     * PathPart constructor.
     * @param string $part
     */
    public function __construct($part)
    {
        $this->part = $part;
    }
}