<?php

declare(strict_types=1);

use App\Container\Container;
use App\Providers\ConfigServiceProvider;

$container = new Container;
(new ConfigServiceProvider($container))->register();

$config = $container->get('config');

foreach ($config['providers'] as $provider) {
    (new $provider($container))->register();
}
