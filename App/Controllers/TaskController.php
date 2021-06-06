<?php

namespace App\Controllers;

use App\Models\Task;

use App\Request;


class TaskController extends BaseController {
    public function action_show() {
        echo 'TaskController -> action_show()<br>';
        $tasks = Task::get_all();
        return $this->response()->view('all_tasks', compact('tasks'));
    }

    public function action_index($id) {
        echo 'TaskController -> action_index()<br>';
        
        $task = new Task;
    }

    public function action_save() {
        $task = new Task;
        $task->fill($this->request->post());

        $method = isset($task->id) ? 'update' : 'save';

        if ($task->$method()) {
            // $this->response()->flash_message('Task accepted');
            echo 'TaskController -> ' . $method . '(): successful<br>';
            $this->response()->get_back();
        }
        else {
            // error
            echo 'TaskController -> ' . $method . '(): error<br>';
            print_r($task->get_errors());
            echo '<br>';
        }
    }
}