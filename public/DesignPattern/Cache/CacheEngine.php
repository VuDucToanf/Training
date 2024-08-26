<?php

namespace Cache;
use Cache\Driver\AbstractDriver;

class CacheEngine
{
    private $driver;

    public function loadDriver(AbstractDriver $driver)
    {
        $this->driver = $driver;
    }

    public function put($key, $value)
    {
        return $this->driver->put($key, $value);
    }

    public function get($key)
    {
        return $this->driver->get($key);
    }
}