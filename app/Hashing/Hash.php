<?php

declare(strict_types=1);

namespace App\Hashing;

class Hash
{
    public function create($value)
    {
        $hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => 12]);
        return $hash;
    }

    public function check($value, $hash)
    {
        return password_verify($value, $hash);
    }
}