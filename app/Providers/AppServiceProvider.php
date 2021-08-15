<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\Connection;
use App\Request\Request;
use App\Router\Router;
use App\Router\RouteResolver;

class AppServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $request = new Request();

        $container->bind(Request::class, $request);
    }
}