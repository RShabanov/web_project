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

        if ($this->request->method() === 'POST') {
            if ($auth->match()) {
                echo 'AuthController -> login(): successful<br>';
                echo 'User_id: ' . $auth->user_id . '<br>';
                Session::authorize($auth->user_id);
    
                $this->response()->redirect('tasks/list');
            }
            else {
                echo 'AuthController -> login(): failed';
            }
        }

        $this->response()->view('auth', compact('auth'));
    }

    public function action_logout() {
        Session::finish_session();
        $this->response()->redirect('login');
    }
}