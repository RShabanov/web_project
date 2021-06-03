<?php


spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});


use App\Components\Router;


ini_set('display_errors', '1');
error_reporting(E_ALL);


define('ROOT', dirname(__FILE__));

$router = new Router;
$router->run();
