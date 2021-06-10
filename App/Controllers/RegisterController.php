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
        echo '<br>' . static::class . ' -> action_create_account()<br>';

        $register = new Register;
        $register->fill($this->request->post());

        if ($this->request->method() === 'POST') {
            echo '<br>RegisterController -> action_create_account() POST<br>';
            // if ($register->create_account()) {
            //     echo '<br>' . static::class . ' -> action_create_account(): successful<br>';
            //     echo 'User_id: ' . $register->user_id . '<br>';
            //     Session::authorize($register->user_id);
    
            //     $this->response()->redirect('tasks/list');
            // }
            // else {
            //     echo '<br>' . static::class . ' -> action_create_account(): failed<br>';
            // }    
        }

        $this->response()->view('register', compact('register'));
    }
}