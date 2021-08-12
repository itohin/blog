<?php

declare(strict_types=1);

namespace App\Auth;

use App\Database\QueryBuilder;
use App\Hashing\Hash;
use App\Session\Session;

class Auth
{
    private QueryBuilder $queryBuilder;

    private Hash $hasher;

    private Session $session;

    public function __construct(QueryBuilder $queryBuilder, Hash $hasher, Session $session)
    {
        $this->queryBuilder = $queryBuilder;
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
        $userId = $this->queryBuilder->insert('users', $inputs);
        $this->session->set('id', $userId);
    }

    public function user()
    {
        if (!$this->session->exists('id')) {
            return null;
        }
        return $this->queryBuilder->selectBy('users', 'id', $this->session->get('id'));
    }

    public function logout()
    {
        $this->session->clear('id');
    }

    public function attempt($username, $password): bool
    {
        $user = $this->getByUsername($username);
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

    protected function getByUsername($username)
    {
        return $this->queryBuilder->selectBy('users', 'email', $username);
    }
}