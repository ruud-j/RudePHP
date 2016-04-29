<?php namespace RudePHP\Response;

class BasicResponse implements Response
{
    protected $contentType = 'text/html';
    protected $responseCode = 200;
    protected $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function show()
    {
        header("Content-Type: {$this->contentType}");
        http_response_code($this->responseCode);
        echo $this->body;
    }
}