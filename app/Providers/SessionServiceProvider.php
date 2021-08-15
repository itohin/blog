<?php

declare(strict_types=1);

namespace App\Providers;

use App\Session\Session;

class SessionServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        $container = $this->getContainer();
        $session = new Session();

        if (!$session->exists('csrf_token')) {
            $token = bin2hex(random_bytes(32));
            $session->set('csrf_token', $token);
        }
        $container->bind(Session::class, $session);
    }
}