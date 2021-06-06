<?php

namespace App\Controllers;

use App\Request;

use App\Session;


class BaseController {
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;

        if (!Session::is_authorized() &&
            !preg_match('~^/login$~', $this->request->url())) {
            $this->response()->redirect('login');
        }
    }

    public function response() {
        return $this->request->create_response();
    }
}