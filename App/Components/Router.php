<?php

namespace App\Components;

use App\Request;

use App\Session;


class Router {
    private $routes = [];

    public function __construct() {
        $routes_path = ROOT . '/App/Config/routes.php';
        $this->routes = require($routes_path);
    }

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];
        $redirect = true;

        foreach ($this->routes as $uri_pattern => $path) {
            if (preg_match("~^$uri_pattern$~", $uri)) {

                $controller_name = ucfirst($path['controller']) . 'Controller';
                $action_name = 'action_' . $path['action'];
                
                $controller_file = ROOT . '/App/Controllers/' . $controller_name . '.php';
                $controller_name = 'App\Controllers\\' . $controller_name;

                echo 'Class: ' . $controller_name . '<br>';
                echo 'Action: ' . $action_name . '<br>';
                echo 'File: ' . $controller_file . '<br><br>';

                if (file_exists($controller_file)) {
                    $request = new Request;

                    echo 'Request method: ' . $request->method() . '<br>';
                    echo '$_SERVER[REQUEST_METHOD]: ' . $_SERVER['REQUEST_METHOD'] . '<br>';

                    $controller = new $controller_name($request);
                    $controller->$action_name();
                    
                    $redirect = false;
                }
                break;
            }
        }

        // if user enter any garbage into URI
        if ($redirect)
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/tasks/list');
    }
}