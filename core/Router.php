<?php

declare(strict_types=1);

namespace Core;

use Closure;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    private array $handlers;

    private Closure $notFoundHandler;

    private Request $request;

    private const METHOD_GET = 'GET';

    private const METHOD_POST = 'POST';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $handler)
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler)
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler(callable $handler)
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler)
    {
        $this->handlers["{$method}{$path}"] = compact('method', 'path', 'handler');
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                if (is_array($handler['handler'])) {
                    $controller = new $handler['handler'][0];
                    $method = $handler['handler'][1];
                    return call_user_func_array([$controller, $method], [$this->request]);
                }
            }
        }

        return call_user_func($this->notFoundHandler);
    }
}
