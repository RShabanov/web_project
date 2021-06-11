<?php

namespace App\Controllers;

use App\Request;

use App\Session;


class BaseController {
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;

        echo 'Is authorized: ' . Session::is_authorized() . '<br>';

        if (!Session::is_authorized() &&
            !preg_match('/AuthController$/', static::class) &&
            !preg_match('/RegisterController$/', static::class)) {
                $this->response()->redirect('login');
        }
    }

    public function response() {
        return $this->request->create_response();
    }
}