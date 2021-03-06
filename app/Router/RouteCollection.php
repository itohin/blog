<?php

declare(strict_types=1);

namespace App\Router;

class RouteCollection
{
    private array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function get($name, $pattern, $handler, array $tokens = []): void
    {
        $this->addRoute(new Route($name, $pattern, $handler, ['GET'], $tokens));
    }

    public function post($name, $pattern, $handler, array $tokens = []): void
    {
        $this->addRoute(new Route($name, $pattern, $handler, ['POST'], $tokens));
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}