<?php

namespace App\Controllers;

use App\Models\Task;

use App\Request;


class TaskController extends BaseController {
    public function action_show() {
        echo 'TaskController -> action_show()<br>';
        $task = new Task;
        return $this->response()->view('show', compact('task'));
    }

    public function action_index($id) {
        echo 'TaskController -> action_index()<br>';
        
        $task = new Task;
    }

    public function action_save() {
        $task = new Task;
        $task->fill($this->request->post());

        if ($task->save()) {
            // $this->response()->flash_message('Task accepted');
            echo 'TaskController -> save(): successful';
        }
        else {
            // error
            echo 'TaskController -> save(): error';
        }
    }

    public function action_add() {
        
    }
}