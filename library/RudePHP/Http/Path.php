<?php namespace RudePHP\Http;

abstract class Path
{
    const PATH_SEPERATOR = '/';

    /**
     * @var string
     */
    protected $path;

    /**
     * Path constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Explodes path string into array
     * '/foo/bar' becomes array('foo', 'bar')
     *
     * @return array
     */
    public function explode()
    {
        $parts = explode(self::PATH_SEPERATOR, $this->path);
        return array_slice($parts, 1);
    }
}