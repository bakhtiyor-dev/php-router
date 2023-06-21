<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Symfony\Component\HttpFoundation\Request;

$registerRoutes = require_once __DIR__ . '/../routes/api.php';

$router = new Router(
    Request::createFromGlobals()
);

$registerRoutes($router);

echo $router->run();
