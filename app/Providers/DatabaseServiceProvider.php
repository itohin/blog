<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\Connection;
use App\Database\QueryBuilder;

class DatabaseServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $config = $container->get('config');
        $connection = Connection::make($config['database']);

        $container->bind('database', $connection);
        $container->bind(QueryBuilder::class, new QueryBuilder($connection));
    }
}