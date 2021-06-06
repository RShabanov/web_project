<?php

namespace App;

use App\Views\View;


class Response {
    protected $request;

    public function __contruct(Request $request) {
        $this->request = $request;
    }

    public function redirect(string $path) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' . $path);
    }

    public function get_back() {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function view($template, $data) {
        header('Content-Type: text/html; charset=utf-8');
        View::view($template, $data);
    }
}