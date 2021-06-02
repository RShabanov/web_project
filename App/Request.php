<?php

namespace App;


class Request {
    protected $get_data = [],
            $post_data = [],
            $url = '',
            $method = 'GET';

    public function __contruct() {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->get_data = $_GET;
        $this->post_data = $_POST;
    }

    public function get($variable = null, $default = null) {
        return $variable === null ? $this->get_data : array_get($this->get_data, $variable, $default);
    }

    public function post($variable = null, $default = null) {
        return $variable === null ? $this->post_data : array_get($this->post_data, $variable, $default);
    }

    public function url() {
        return $this->url;
    }

    public function method() {
        return $this->method;
    }

    public function create_response() {
        return new Response($this);
    }
}