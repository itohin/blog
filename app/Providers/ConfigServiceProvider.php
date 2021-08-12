<?php

declare(strict_types=1);

namespace App\Providers;

class ConfigServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $config = require __DIR__ . '/../config/app.php';
        $container = $this->getContainer();
        $container->bind('config', $config);
    }
}