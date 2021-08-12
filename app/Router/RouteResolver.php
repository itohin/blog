<?php

declare(strict_types=1);

namespace App\Router;

use App\Container\Container;
use App\Request\Request;
use Exception;
use ReflectionClass;

class RouteResolver
{
    private Request $request;
    private Container $container;

    public function __construct(Request $request, Container $container)
    {
        $this->request = $request;
        $this->container = $container;
    }

    public function resolve(array $handlers)
    {
        $method = strtolower($this->request->getMethod());
        $uri = $this->request->getUri();
        $uri = preg_split("/-/", $uri, 2);
        $name = $uri[0];

        if (!isset($handlers[$method])) {
            throw new Exception('Method not allowed.');
        }
        if (!isset($handlers[$method][$name])) {
            throw new Exception('Route not defined.');
        }
        $handlers = $handlers[$method][$name];

        $controller = $this->getController($handlers);
        $action = $this->getAction($handlers, get_class($controller));
        $param = $this->getParam($uri, $handlers);

        return !is_null($param) ?
            $controller->$action($param) :
            $controller->$action();
    }

    protected function getParam(array $uri, array $handlers)
    {
        if (!$handlers['param']) {
            return null;
        }
        if (!isset($uri[1]) || empty($uri[1])) {
            throw new Exception('Param required.');
        }
        return $uri[1];
    }

    protected function getController(array $handlers)
    {
        $controller = "App\\Controllers\\" . $handlers['controller'];
        if (!class_exists($controller)) {
            throw new Exception('Class not defined.');
        }

        $reflection = new ReflectionClass($controller);
        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            return new $controller;
        }
        $dependencies = $this->getDependencies($constructor);
        return new $controller(...$dependencies);
    }

    protected function getAction(array $handlers, string $controller): string
    {
        $action = $handlers['action'];
        if (!method_exists($controller, $action)) {
            throw new Exception('Action not defined.');
        }
        return $action;
    }

    protected function getDependencies($constructor): array
    {
        $dependencies = [];
        $params = $constructor->getParameters();
        foreach ($params as $param) {
            $dependancyName = $param->getClass()->name;
            $dependancy = $this->container->get($dependancyName);
            $dependencies[] = $dependancy;
        }
        return $dependencies;
    }
}