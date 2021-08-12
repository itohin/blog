<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Request\Request;
use App\Validator\Validator;

class BaseController
{
    public function validate(array $inputs, array $rules) :Validator
    {
        $validator = new Validator($inputs);
        return $validator->validate($rules);
    }

    public function view(string $path, $data = [])
    {
        extract($data);
        return require_once base_path($path . '.php');
    }

    public function redirect($path)
    {
        header('Location: ' . $path);
    }
}