<?php

use App\Router\DefaultRouter;

require __DIR__ . '/../vendor/autoload.php';

$router = new DefaultRouter();
try {
    $router->start();
    $router->dispatch();
} catch (Exception $e) {
    $router->handleError($e);
}