<?php

declare(strict_types=1);

use App\Request\Request;
use App\Router\Router;
use App\Router\RouteResolver;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once base_path('/bootstrap/container.php');

$router = $container->get(Router::class);
$request = $container->get(Request::class);
$routeResolver = $container->get(RouteResolver::class);

$matchedRoute = $router->match($request);

try {
    $routeResolver->resolve($matchedRoute);
} catch (Exception $e) {
    http_response_code(404);
    echo 'Page not found';
    die();
}
