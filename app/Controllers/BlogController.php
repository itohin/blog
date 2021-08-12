<?php

declare(strict_types=1);

namespace App\Controllers;

class BlogController
{
    public function index()
    {
        var_dump('Blog page');
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