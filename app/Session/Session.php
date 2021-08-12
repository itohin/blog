<?php

declare(strict_types=1);

namespace App\Session;

class Session
{
    public function get($key, $default = null)
    {
        if ($this->exists($key)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $sessionKey => $sessionValue) {
                $_SESSION[$sessionKey] = $sessionValue;
            }
            return;
        }
        $_SESSION[$key] = $value;
    }

    public function exists($key): bool
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    public function clear(...$key)
    {
        foreach($key as $sessionKey) {
            unset($_SESSION[$sessionKey]);
        }
    }
}