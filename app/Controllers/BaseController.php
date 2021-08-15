<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Session\Session;
use App\Validator\Validator;

class BaseController
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function validate(array $inputs, array $rules) :Validator
    {
        $validator = new Validator($inputs);
        return $validator->validate($rules);
    }

    public function view(string $path, $data = [])
    {
        extract($data);
        $errors = $this->session->get('errors', []);
        $error = $this->session->get('error', null);
        $old = $this->session->get('old', []);
        $this->session->clear('error', 'errors', 'old');
        return require_once base_path($path . '.php');
    }

    public function redirect($path)
    {
        header('Location: ' . $path);
    }
}