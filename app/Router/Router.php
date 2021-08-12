<?php

declare(strict_types=1);

namespace App\Router;

class Router
{
    private array $methods;

    private RouteResolver $resolver;

    private array $handlers;

    public function __construct(RouteResolver $resolver)
    {
        $this->resolver = $resolver;
        $this->handlers = [];
        $this->methods = [
            'GET',
            'POST',
            'PUT',
            'PATCH',
            'DELETE'
        ];
    }

    public function add(string $method, string $name, string $args): void
    {
        if (!in_array(strtoupper($method), $this->methods)) {
            throw new \Exception('Unsupported method.');
        }

        [$controller, $action] = explode('@', $args);
        $name = preg_split("/-/", $name, 2);

        $this->handlers[$method][$name[0]] = [
            'controller' => $controller,
            'action' => $action,
            'param' => isset($name[1])
        ];
    }

    public function resolve()
    {
        return $this->resolver->resolve($this->handlers);
    }

    public function getHandlers(): array
    {
        return $this->handlers;
    }
}