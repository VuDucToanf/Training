<?php

namespace Cache\Driver;

class FileDriver extends AbstractDriver
{
    public function put($key, $value)
    {
        echo 'This is "put" method to File for key: ' . $key . PHP_EOL;
    }

    public function get($key)
    {
        echo 'This is "get" method to File for key: ' . $key . PHP_EOL;
    }
}
