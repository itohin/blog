<?php

declare(strict_types=1);

namespace App\Providers;

use App\Router\RouteCollection;
use App\Router\Router;
use App\Router\RouteResolver;

class RouteServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();

        $routes = new RouteCollection();
        require_once base_path('/app/routes.php');

        $router = new Router($routes);

        $container->bind(Router::class, $router);
        $container->bind(RouteResolver::class, new RouteResolver($container));
    }
}