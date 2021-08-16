<?php

declare(strict_types=1);

namespace App\Request;

class Request
{
    private string $uri;

    private string $method;

    private array $params;

    private array $query;

    public function __construct()
    {
        $this->uri = $this->parseUri();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = array_filter(filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING) ?? []);
        $this->query = array_filter(filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING) ?? []);
    }

    public function getBody(): array
    {
        return $this->params;
    }

    public function getQuery(): array
    {
        return $this->query;
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