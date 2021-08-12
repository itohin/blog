<?php

declare(strict_types=1);

$router->add('get', '/', 'BlogController@index');

$router->add('get', '/blog-{date}', 'BlogController@show');
$router->add('get', '/addblog', 'BlogController@create');
