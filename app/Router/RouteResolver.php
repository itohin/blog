<?php

declare(strict_types=1);

namespace App\Router;

use App\Session\Session;
use Exception;
use ReflectionClass;
use App\Container\Container;

class RouteResolver
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @throws Exception
     */
    public function resolve(Result $result)
    {
        $controller = $this->makeController($result->getController());
        if (is_null($controller)) {
            throw new Exception('Controller not defined.');
        }
        $action = $result->getAction();
        $params = array_values($result->getAttributes());

        return $controller->$action(...$params);
    }


    /**
     * @return mixed|null
     * @throws Exception
     */
    protected function makeController(string $controllerName)
    {
        if ($this->container->has($controllerName)) {
            return $this->container->get($controllerName);
        }
        if (!class_exists($controllerName)) {
            return null;
        }

        $reflection = new ReflectionClass($controllerName);
        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            return new $controllerName;
        }
        $dependencies = $this->getDependencies($constructor);
        return new $controllerName(...$dependencies);
    }

    protected function getDependencies($constructor): array
    {
        $dependencies = [];
        $params = $constructor->getParameters();
        foreach ($params as $param) {
            $dependencyName = $param->getClass()->name;
            $dependency = $this->container->get($dependencyName);
            $dependencies[] = $dependency;
        }
        return $dependencies;
    }
}