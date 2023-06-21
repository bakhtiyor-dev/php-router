<?php

declare(strict_types=1);

namespace Core;

use Closure;

class Router
{
    private array $handlers;

    private Closure $notFoundHandler;

    private const METHOD_GET = 'GET';

    private const METHOD_POST = 'POST';

    public function get(string $path, callable $handler)
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, callable $handler)
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler(callable $handler)
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, callable $handler)
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
                return call_user_func($handler['handler']);
            }
        }

        return call_user_func($this->notFoundHandler);
    }
}
