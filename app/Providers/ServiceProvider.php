<?php

declare(strict_types=1);

namespace App\Providers;

use App\Container\Container;

class ServiceProvider
{
    private Container $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}