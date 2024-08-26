<?php

namespace Cache\Driver;

class RedisDriver extends AbstractDriver
{
    public function put($key, $value)
    {
        echo 'This is "put" method to Redis for key: ' . $key . PHP_EOL;
    }

    public function get($key)
    {
        echo 'This is "get" method to Redis for key: ' . $key  . PHP_EOL;
    }
}
