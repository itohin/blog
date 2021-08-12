<?php

declare(strict_types=1);

namespace App\Request;

class Request
{
    private string $uri;
    private string $method;

    public function __construct()
    {
        $this->uri = $this->parseUri();
        $this->method = $_SERVER['REQUEST_METHOD'];
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