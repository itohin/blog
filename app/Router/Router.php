<?php

declare(strict_types=1);

namespace App\Router;

use App\Request\Request;
use Exception;

class Router
{
    private RouteCollection $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @throws Exception
     */
    public function match(Request $request): Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($result = $route->match($request)) {
                return $result;
            }
        }

        throw new Exception('Request not matched');
    }

    /**
     * @throws Exception
     */
    public function generate($name, array $params = []): string
    {
        foreach ($this->routes->getRoutes() as $route) {
            if (null !== $url = $route->generate($name, array_filter($params))) {
                return $url;
            }
        }

        throw new Exception('Route not found');
    }
}