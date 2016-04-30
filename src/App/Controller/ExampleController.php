<?php namespace App\Controller;

use RudePHP\Controller\BaseController;
use RudePHP\Http\Response\TwigResponse;

class ExampleController extends BaseController
{
    public function show($message)
    {
        return new TwigResponse('example/show.html.twig', [
            'message' => $message,
        ]);
    }

    public function create()
    {
        return new TwigResponse('example/show.html.twig', [
            'message' => 'POST example',
        ]);
    }
}