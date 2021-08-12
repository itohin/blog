<?php

declare(strict_types=1);

namespace App\Container;

class Container
{
    protected array $dependencies = [];
    protected array $providers = [];

    public function bind($key, $value)
    {
        $this->dependencies[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        if (!isset($this->dependencies[$key])) {
            throw new \Exception("Key {$key} doesn't exist in the container.");
        }

        return $this->dependencies[$key];
    }

    public function addProvider($provider)
    {
        $this->providers[] = $provider;
        return $this;
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}