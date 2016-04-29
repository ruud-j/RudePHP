<?php namespace RudePHP\Response;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

class TwigResponse extends BasicResponse
{
    private $template;
    private $variables;

    public function __construct($template, $variables)
    {
        $this->template = $template;
        $this->variables = $variables;
    }

    public function show()
    {
        header("Content-Type: {$this->contentType}");
        http_response_code($this->responseCode);

        $loader = new Twig_Loader_Filesystem('../src/App/View');
        $twig = new Twig_Environment($loader, array(
            'cache' => '../cache/twig',
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        echo $twig->render($this->template, $this->variables);
    }
}