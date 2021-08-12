<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Controllers\BaseController;
use App\Hashing\Hash;
use App\Request\Request;
use App\Session\Session;

class LoginController extends BaseController
{
    protected Request $request;

    protected Session $session;

    protected Hash $hasher;

    protected Auth $auth;

    public function __construct(Request $request, Session $session, Hash $hasher, Auth $auth)
    {
        $this->request = $request;
        $this->session = $session;
        $this->hasher = $hasher;
        $this->auth = $auth;
    }

    public function index()
    {
        if ($this->auth->user()) {
            return $this->redirect('/');
        }
        $errors = $this->session->get('errors', []);
        $old = $this->session->get('old', []);
        $error = $this->session->get('error', null);


        return $this->view('/views/auth/login', compact('errors', 'old', 'error'));
    }

    public function login()
    {
        $this->session->clear('errors', 'old', 'error');
        $validator = $this->validate($inputs = $this->request->getBody(), [
            'email' => ['required', 'email'],
            'password' => ['required', ['min' => 8]]
        ]);
        if ($validator->hasErrors()) {
            $this->session->set([
                'errors' => $validator->getErrors(),
                'old' => $inputs
            ]);
            return $this->redirect('/login');
        }

        $attempt = $this->auth->attempt($inputs['email'], $inputs['password']);

        if (!$attempt) {
            $this->session->set('error', 'Wrong credentials.');
            return $this->redirect('/login');
        }
        return $this->redirect('/');
    }
}