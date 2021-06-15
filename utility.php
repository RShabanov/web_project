<?php


spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

function array_get($array, $key, $default = '') {
    $array = (array)$array;
    if (isset($array[$key]))
    {
        return $array[$key];
    }

    return $default;
}