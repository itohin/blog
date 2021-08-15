<?php

declare(strict_types=1);

namespace App\Router;

class Result
{
    private string $name;

    private string $controller;

    private string $action;

    private array $attributes;

    public function __construct($name, $controller, $action, array $attributes)
    {
        $this->name = $name;
        $this->controller = $controller;
        $this->action = $action;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}