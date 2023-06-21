<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

$router->get('/', function () {
    return json_encode(['type' => 'asdsa']);
});

$router->addNotFoundHandler(fn() => 'Not Found!');

echo $router->run();
