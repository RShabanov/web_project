<?php

namespace App\Controllers;

use App\Request;


class BaseController {
    protected $request;

    public function __contruct(Request $request) {
        $this->request = $request;
    }

    public function response() {
        return $this->request->create_response();
    }
}