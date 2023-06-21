<?php

use Core\Router;

return function (Router $router) {
    $router->get('/', function (\Symfony\Component\HttpFoundation\Request $request) {
        return json_encode(['type' => 'asdsa']);
    });

    $router->addNotFoundHandler(fn() => 'Not Found!');
};
