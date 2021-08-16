<?php

declare(strict_types=1);

use App\Request\Request;
use App\Router\Router;
use App\Router\RouteResolver;
use App\Session\Session;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once base_path('/bootstrap/app.php');

$router = $container->get(Router::class);
$request = $container->get(Request::class);
$routeResolver = $container->get(RouteResolver::class);
$session = $container->get(Session::class);

if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
    $postToken = $request->csrf_token;
    $sessionToken = $session->get('csrf_token');

    if ($postToken !== $sessionToken) {
        http_response_code(419);
        echo "CSRF token Mismatch";
        die();
    }
}

$matchedRoute = $router->match($request);

try {
    $routeResolver->resolve($matchedRoute);
} catch (Exception $e) {
    http_response_code(404);
    echo 'Page not found';
    die();
}
