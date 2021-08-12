<?php

declare(strict_types=1);

namespace App\Providers;

use App\Container\Container;

class AppServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $this->getContainer()->bind('test', 'It works');
    }
}