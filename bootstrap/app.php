<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/container.php';

$router = $container->get('router');
require_once __DIR__ . '/../app/routes.php';

try {
    $router->resolve();
} catch (Exception $e) {
    var_dump($e->getMessage());
    http_response_code(404);
    echo 'Page not found';
    die();
}
