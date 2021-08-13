<?php

declare(strict_types=1);

namespace App\Auth;

use App\Hashing\Hash;
use App\Repositories\UsersRepository;
use App\Session\Session;

class Auth
{
    private UsersRepository $repository;

    private Hash $hasher;

    private Session $session;

    public function __construct(UsersRepository $repository, Hash $hasher, Session $session)
    {
        $this->repository = $repository;
        $this->hasher = $hasher;
        $this->session = $session;
    }

    public function createUser($inputs)
    {
        $inputs = [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => $this->hasher->create($inputs['password'])
        ];
        $userId = $this->repository->create($inputs);
        $this->session->set('id', $userId);
    }

    public function user()
    {
        if (!$this->session->exists('id')) {
            return null;
        }
        return $this->repository->findBy('id', $this->session->get('id'));
    }

    public function logout()
    {
        $this->session->clear('id');
    }

    public function attempt($email, $password): bool
    {
        $user = $this->getByEmail($email);
        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        $this->session->set('id', $user->id);
        return true;
    }

    protected function hasValidCredentials($user, $password): bool
    {
        return $this->hasher->check($password, $user->password);
    }

    protected function getByEmail($email)
    {
        return $this->repository->findBy('email', $email);
    }
}