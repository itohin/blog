<?php

declare(strict_types=1);

namespace App\Providers;

use App\Hashing\Hash;

class HasherServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();

        $container->bind(Hash::class, new Hash());
    }
}