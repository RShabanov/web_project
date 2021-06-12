<?php

namespace App\Controllers;

use App\Models\Register;

use App\Request;

use App\Session;


class RegisterController extends BaseController {

    public function __construct(Request $request) {        
        if (Session::is_authorized()) {
            $this->response()->redirect('tasks/list');
        }
        
        parent::__construct($request);
    }

    public function action_create_account() {
        $register = new Register;
        $register->fill($this->request->post());

        if ($this->request->method() === 'POST') {
            if ($register->create_account()) {
                Session::authorize($register->user_id);
    
                $this->response()->redirect('tasks/list');
            }
        }

        $this->response()->view('register', compact('register'));
    }
}