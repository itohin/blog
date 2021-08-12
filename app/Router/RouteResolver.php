<?php

declare(strict_types=1);

namespace App\Router;

use App\Core\Container;
use App\Request\Request;

class RouteResolver
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function resolve(array $handlers)
    {
        $method = strtolower($this->request->getMethod());
        $uri = $this->request->getUri();
        $uri = preg_split("/-/", $uri, 2);
        $name = $uri[0];

        if (!isset($handlers[$method])) {
            throw new \Exception('Method not allowed.');
        }
        if (!isset($handlers[$method][$name])) {
            throw new \Exception('Route not defined.');
        }
        $handlers = $handlers[$method][$name];
        $controller = $this->getController($handlers);
        $action = $this->getAction($handlers, $controller);
        $param = $this->getParam($uri, $handlers);

        return !is_null($param) ?
            (new $controller)->$action($param) :
            (new $controller)->$action();
    }

    protected function getParam(array $uri, array $handlers)
    {
        if (!$handlers['param']) {
            return null;
        }
        if (!isset($uri[1]) || empty($uri[1])) {
            throw new \Exception('Param required.');
        }
        return $uri[1];
    }

    protected function getController(array $handlers): string
    {
        $controller = "App\\Controllers\\" . $handlers['controller'];
        if (!class_exists($controller)) {
            throw new \Exception('Class not defined.');
        }

        return $controller;
    }

    protected function getAction(array $handlers, string $controller): string
    {
        $action = $handlers['action'];
        if (!method_exists($controller, $action)) {
            throw new \Exception('Action not defined.');
        }
        return $action;
    }
}