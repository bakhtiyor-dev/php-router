<?php

declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$registerRoutes = require_once __DIR__ . '/../routes/api.php';

$router = new Router(
    Request::createFromGlobals()
);

$registerRoutes($router);

echo $router->run();
