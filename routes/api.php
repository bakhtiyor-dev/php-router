<?php

use App\Controllers\ProductController;
use Core\Router;

return function (Router $router) {
    $router->get('/product/get', [ProductController::class, 'index']);
    $router->post('/product/saveApi', [ProductController::class, 'store']);
    $router->post('/product/massDelete', [ProductController::class, 'delete']);
    $router->addNotFoundHandler(fn() => 'Not Found!');
};
