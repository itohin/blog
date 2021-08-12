<?php

declare(strict_types=1);

$router->add('get', '/login', 'Auth\\LoginController@index');
$router->add('post', '/login', 'Auth\\LoginController@login');
$router->add('post', '/logout', 'Auth\\LogoutController@logout');

$router->add('get', '/register', 'Auth\\RegisterController@index');
$router->add('post', '/register', 'Auth\\RegisterController@register');

$router->add('get', '/', 'BlogController@index');

$router->add('get', '/blog-{date}', 'BlogController@show');
$router->add('get', '/addblog', 'BlogController@create');
$router->add('post', '/addblog', 'BlogController@store');
$router->add('get', '/editblog-{date}', 'BlogController@edit');
$router->add('post', '/editblog-{date}', 'BlogController@update');
