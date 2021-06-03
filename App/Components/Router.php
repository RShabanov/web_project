<?php

namespace App\Components;

use App\Request;


class Router {
    private $routes = [];

    public function __construct() {
        $routes_path = ROOT . '/App/Config/routes.php';
        $this->routes = require($routes_path);
    }

    private function get_URI() {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run() {
        $uri = $this->get_URI();

        foreach ($this->routes as $uri_pattern => $path) {
            if (preg_match("~$uri_pattern~", $uri)) {

                $controller_name = ucfirst($path['controller']) . 'Controller';
                $action_name = 'action_' . $path['action'];
                
                $controller_file = ROOT . '/App/Controllers/' . $controller_name . '.php';
                $controller_name = 'App\Controllers\\' . $controller_name;

                echo 'Class: ' . $controller_name . '<br>';
                echo 'Action: ' . $action_name . '<br>';
                echo 'File: ' . $controller_file . '<br><br>';

                if (file_exists($controller_file)) {
                    $request = new Request;

                    $controller = new $controller_name($request);
                    $controller->$action_name();
                }
                break;
            }
        }
    }
}