<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Request\Request;

class LoginController extends BaseController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return $this->view('/views/auth/login');
    }

    public function login()
    {
        $this->validate($this->request, [
            'email' => ['required', 'email'],
            'password' => ['required', ['min' => 8]]
        ]);
    }
}