<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Auth\Auth;

class BlogController extends BaseController
{
    protected Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        $user = $this->auth->user();
        return $this->view('/views/blog/index', compact('user'));
    }

    public function create()
    {
        var_dump('Create Post');
    }

    public function show(string $date)
    {
        var_dump('Show Post');
    }
}