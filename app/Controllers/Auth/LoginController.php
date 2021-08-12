<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Request\Request;
use App\Session\Session;

class LoginController extends BaseController
{
    protected Request $request;

    protected Session $session;

    public function __construct(Request $request, Session $session)
    {
        $this->request = $request;
        $this->session = $session;
    }

    public function index()
    {
        return $this->view('/views/auth/login');
    }

    public function login()
    {
        $validator = $this->validate($inputs = $this->request->getBody(), [
            'email' => ['required', 'email'],
            'password' => ['required', ['min' => 8]]
        ]);
        if ($validator->hasErrors()) {
            $this->session->set([
                'errors' => $validator->getErrors(),
                'old' => $inputs
            ]);
            var_dump($_SESSION);
            die();
            $this->redirect('/login');
        }

    }
}