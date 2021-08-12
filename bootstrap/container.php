<?php

declare(strict_types=1);

$container = new \App\Container\Container;
$provider = new \App\Providers\AppServiceProvider($container);

$container->addProvider($provider);

foreach ($container->getProviders() as $provider) {
    $provider->register();
}

var_dump($container->get('test'));
