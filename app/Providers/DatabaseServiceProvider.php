<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\Connection;
use App\Database\QueryBuilder;
use App\Repositories\BlogRepository;
use App\Repositories\UsersRepository;

class DatabaseServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $config = $container->get('config');
        $connection = Connection::make($config['database']);
        $builder = new QueryBuilder($connection);

        $container->bind('database', $connection);
        $container->bind(QueryBuilder::class, $builder);
        $container->bind(BlogRepository::class, new BlogRepository($builder));
        $container->bind(UsersRepository::class, new UsersRepository($builder));
    }
}