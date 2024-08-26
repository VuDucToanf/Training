<?php

require_once 'cache/CacheEngine.php';
require_once 'cache/driver/AbstractDriver.php';
require_once 'cache/driver/implements/FileDriver.php';
require_once 'cache/driver/implements/RedisDriver.php';

use Cache\CacheEngine;
use Cache\Driver\FileDriver;
use Cache\Driver\RedisDriver;

$cache = new CacheEngine();
$cache->loadDriver(new FileDriver());
//$cache->loadDriver(new RedisDriver());
$cache->put('example_key', 'example_value');
echo $cache->get('example_key');
