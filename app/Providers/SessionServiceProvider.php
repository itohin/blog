<?php

declare(strict_types=1);

namespace App\Providers;

use App\Session\Session;

class SessionServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $container->bind(Session::class, new Session());
    }
}