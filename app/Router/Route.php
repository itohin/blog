<?php

declare(strict_types=1);

namespace App\Router;

use App\Request\Request;

class Route
{
    private string $name;
    private string $pattern;
    private string $controller;
    private string $action;
    private array $tokens;
    private array $methods;

    public function __construct($name, $pattern, $handler, array $methods, array $tokens = [])
    {
        [$controller, $action] = explode('@', $handler);
        $action = preg_split("/-/", $action, 2);

        $this->name = $name;
        $this->pattern = $pattern;
        $this->controller = "App\\Controllers\\" . $controller;
        $this->action = $action[0];
        $this->tokens = $tokens;
        $this->methods = $methods;
    }

    public function match(Request $request): ?Result
    {
        if (!in_array($request->getMethod(), $this->methods, true)) {
            return null;
        }

        $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) {
            $argument = $matches[1];
            $replace = $this->tokens[$argument] ?? '[^}]+';
            return '(?<' . $argument . '>' . $replace . ')';
        }, $this->pattern);

        $path = $request->getUri();
        $pattern = '~^' . $pattern . '$~i';

        if (!preg_match($pattern, $path, $matches)) {
            return null;
        }

        return new Result(
            $this->name,
            $this->controller,
            $this->action,
            array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
        );
    }
}