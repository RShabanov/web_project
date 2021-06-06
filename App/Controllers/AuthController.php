<?php

namespace App\Controllers;

use App\Models\Auth;

use App\Request;

use App\Session;


class AuthController extends BaseController {
    public function action_login() {
        if (Session::is_authorized()) {
            $this->response()->redirect('tasks/list');
        }
        echo '<br>AuthController -> action_login()<br>';

        $auth = new Auth;
        $auth->fill($this->request->post());
        $this->response()->view('auth', compact('auth'));

        if ($auth->match()) {
            echo 'AuthController -> login(): successful<br>';
            echo 'User_id: ' . $auth->user_id . '<br>';
            Session::authorize($auth->user_id);

            echo Session::is_authorized() . '<br>';
            $this->response()->redirect('tasks/list');
        }
        else {
            echo 'AuthController -> login(): failed';

        }
    }

    public function action_logout() {
        echo '<br>AuthController -> action_logout()<br>';
        Session::finish_session();
        $this->response()->redirect('login');

    }

    public function action_signup() {
        echo '<br>AuthController -> action_signup()<br>';

    }
}