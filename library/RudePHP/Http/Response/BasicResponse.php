<?php namespace RudePHP\Http\Response;

class BasicResponse implements Response
{
    /**
     * @var string
     */
    protected $contentType = 'text/html';

    /**
     * @var int
     */
    protected $responseCode = 200;

    /**
     * @var string
     */
    protected $body;

    /**
     * BasicResponse constructor.
     * @param string $body
     */
    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * Displays Response
     */
    public function show()
    {
        header("Content-Type: {$this->contentType}");
        http_response_code($this->responseCode);
        echo $this->body;
    }
}