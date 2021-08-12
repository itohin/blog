<?php

declare(strict_types=1);

use App\Router\Router;
use App\Session\Session;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once base_path('/bootstrap/container.php');

$router = $container->get(Router::class);
require_once base_path('/app/routes.php');

try {
    $router->resolve();
} catch (Exception $e) {
    var_dump($e->getMessage());
    http_response_code(404);
    echo 'Page not found';
    die();
}
