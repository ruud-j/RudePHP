<?php namespace RudePHP\Http\Response;

use RudePHP\Exception\NotFoundException;

class ErrorResponse extends BasicResponse
{
    /**
     * ErrorResponse constructor.
     * @param \Exception $e
     */
    public function __construct(\Exception $e)
    {
        if ($e instanceof NotFoundException) {
            $this->responseCode = 404;
            $this->body = "404 Not found: " . get_class($e);
        } else {
            $this->responseCode = 500;
            $this->body = $e->getMessage() . '<pre>' . $e->getTraceAsString();
        }
    }
}