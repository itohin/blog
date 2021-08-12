<?php

namespace App\Providers;

use App\Auth\Auth;
use App\Database\QueryBuilder;
use App\Hashing\Hash;
use App\Session\Session;

class AuthServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();

        $container->bind(Auth::class, new Auth(
            $container->get(QueryBuilder::class),
            $container->get(Hash::class),
            $container->get(Session::class)
        ));
    }
}