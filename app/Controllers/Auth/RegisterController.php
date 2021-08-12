<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Controllers\BaseController;
use App\Hashing\Hash;
use App\Request\Request;
use App\Session\Session;

class RegisterController extends BaseController
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

        return $this->view('/views/auth/register', compact('errors', 'old'));
    }

    public function register()
    {
        $inputs = $this->request->getBody();
        $this->validateRegistration($inputs);
        try {
            $this->auth->createUser($inputs);
            return $this->redirect('/');
        } catch (\Exception $e) {
            return $this->redirect('/register');
        }
    }

    protected function validateRegistration(array $inputs)
    {
        $this->session->clear('errors', 'old');
        $validator = $this->validate($inputs, [
            'name' => ['required', ['min' => 3]],
            'email' => ['required', 'email'],
            'password' => ['required', ['min' => 8]],
            'confirmation' => ['required', ['match' => 'password']]
        ]);
        if ($validator->hasErrors()) {
            $this->session->set([
                'errors' => $validator->getErrors(),
                'old' => $inputs
            ]);
            return $this->redirect('/register');
        }
    }
}