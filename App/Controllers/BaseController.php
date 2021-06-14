<?php

namespace App\Controllers;

use App\Request;

use App\Session;


class BaseController {
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function response() {
        return $this->request->create_response();
    }
}