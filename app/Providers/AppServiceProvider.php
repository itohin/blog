<?php

declare(strict_types=1);

namespace App\Providers;

use App\Container\Container;
use App\Database\Connection;
use App\Request\Request;
use App\Router\Router;
use App\Router\RouteResolver;

class AppServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $config = require __DIR__ . '/../config/app.php';
        $container = $this->getContainer();
        $request = new Request();

        $container->bind('database', new Connection($config['database']));
        $container->bind('request', $request);
        $container->bind('router', new Router(new RouteResolver($request)));
    }
}