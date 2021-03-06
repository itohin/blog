<?php

declare(strict_types=1);

namespace App\Container;

use Exception;

class Container
{
    protected array $dependencies = [];
    protected array $providers = [];

    public function bind($key, $value): self
    {
        $this->dependencies[$key] = $value;
        return $this;
    }

    public function has($key): bool
    {
        return isset($this->dependencies[$key]);
    }

    /**
     * @throws Exception
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new Exception("Key {$key} doesn't exist in the container.");
        }

        return $this->dependencies[$key];
    }

    public function addProvider($provider): self
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