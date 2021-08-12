<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\Connection;

class DatabaseServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $config = $container->get('config');

        $container->bind('database', Connection::make($config['database']));
    }
}