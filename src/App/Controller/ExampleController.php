<?php namespace App\Controller;

use RudePHP\Controller\BaseController;
use RudePHP\Response\TwigResponse;

class ExampleController extends BaseController
{
    public function show($message)
    {
        return new TwigResponse('example/show.html.twig', [
            'message' => $message,
        ]);
    }
}