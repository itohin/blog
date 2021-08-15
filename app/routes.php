<?php

declare(strict_types=1);

$routes->get('login.index', '/login', 'Auth\\LoginController@index');
$routes->post('login.store', '/login', 'Auth\\LoginController@login');
$routes->post('logout', '/logout', 'Auth\\LogoutController@logout');

$routes->get('register.index', '/register', 'Auth\\RegisterController@index');
$routes->post('register', '/register', 'Auth\\RegisterController@register');

$routes->get('home', '/', 'BlogController@index');

$routes->get('blog.index', '/blog-{date}', 'BlogController@show', ['date' => '\d{4}-\d{2}-\d{2}']);
$routes->get('blog.create', '/addblog', 'BlogController@create');
$routes->post('blog.store', '/addblog', 'BlogController@store');
$routes->get('blog.edit', '/editblog-{date}', 'BlogController@edit', ['date' => '\d{4}-\d{2}-\d{2}']);
$routes->post('blog.update', '/editblog-{date}', 'BlogController@update', ['date' => '\d{4}-\d{2}-\d{2}']);