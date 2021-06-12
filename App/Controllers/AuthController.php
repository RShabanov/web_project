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

        $auth = new Auth;
        $auth->fill($this->request->post());

        if ($this->request->method() === 'POST') {
            if ($auth->match()) {
                Session::authorize($auth->user_id);
    
                $this->response()->redirect('tasks/list');
            }
        }

        $this->response()->view('auth', compact('auth'));
    }

    public function action_logout() {
        Session::finish_session();
        $this->response()->redirect('login');
    }
}