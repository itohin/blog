<?php

declare(strict_types=1);

namespace App\Request;

class Request
{
    private string $uri;

    private string $method;

    private array $params;

    public function __construct()
    {
        $this->uri = $this->parseUri();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $params = $this->method === 'GET' ? $_GET : $_POST;
        $this->params = array_filter($params);
    }

    public function getBody()
    {
        return $this->params;
    }

    public function __get($name)
    {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }

        return null;
    }

    protected function parseUri(): string
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';
        if ($path === '/') {
            return $path;
        }

        return rtrim($path, '/');
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}