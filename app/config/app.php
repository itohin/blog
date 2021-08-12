<?php

return [
    'database' => [
        'name' => 'blog',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],

    'providers' => [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\DatabaseServiceProvider::class
    ]
];