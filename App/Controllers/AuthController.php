<?php

namespace App\Controllers;

use App\Models\Auth;

use App\Request;

use App\Session;


class AuthController extends BaseController {
    public function action_login() {
        echo '<br>AuthController -> action_login()<br>';

        $auth = new Auth;
        $auth->fill($this->request->post());
        echo $this->response()->view('auth', compact('auth'));

        if ($auth->match()) {
            echo 'AuthController -> login(): successful';
            if (!Session::is_authorized()) {
                Session::authorize($auth->user_id);
            }
        }
        else {
            echo 'AuthController -> login(): failed';
        }
    }

    public function action_logout() {
        echo '<br>AuthController -> action_logout()<br>';

    }

    public function action_signup() {
        echo '<br>AuthController -> action_signup()<br>';

    }
}