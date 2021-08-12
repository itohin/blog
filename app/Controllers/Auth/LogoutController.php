<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    protected Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function logout()
    {
        $this->auth->logout();
        return $this->redirect('/');
    }
}