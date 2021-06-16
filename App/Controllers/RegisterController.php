<?php

namespace App\Controllers;

use App\Models\Register;

use App\Request;

use App\Session;


class RegisterController extends BaseController {

    public function __construct(Request $request) {  
        parent::__construct($request);

        if (Session::is_authorized()) {
            $this->response()->redirect('tasks/list');
        }        
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