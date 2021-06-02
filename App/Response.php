<?php

namespace App;


class Response {
    protected $request;

    public function __contruct(Request $request) {
        $this->request = $request;
    }

    public function redirect(string $path) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' . $page_path);
    }

    public function get_back() {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}