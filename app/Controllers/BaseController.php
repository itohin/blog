<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Request\Request;
use App\Validator\Validator;

class BaseController
{
    public function validate(Request $request, array $rules)
    {
        $validator = new Validator($request->getBody());
        $isValid = $validator->validate($rules);
        if (!$isValid) {
            var_dump($validator->getErrors());
            die();
        }
        var_dump('true');
    }

    public function view(string $path)
    {
        return require base_path($path . '.php');
    }
}