<?php

namespace App\Controllers;

use App\Models\Task;

use App\Request;


class TaskController extends BaseController {
    public function action_show() {
        echo 'TaskController -> action_show()<br>';
        $tasks = Task::get_all();
        $this->response()->view('all_tasks', compact('tasks'));
    }

    public function action_save() {
        if ($this->request->method() === 'GET') {
            $this->response()->redirect('tasks/list');
        }

        $task = new Task;
        $task->fill($this->request->post());
        if (!empty($this->request->post()['id']))
            $task->id = $this->request->post()['id'];

        $method = isset($task->id) ? 'update' : 'save';

        if ($task->$method()) {
            echo 'TaskController -> ' . $method . '(): successful<br>';
            $this->response()->get_back();
        }
        else {
            // error
            echo 'TaskController -> ' . $method . '(): error<br>';
            print_r($task->get_errors());
            echo '<br>';
        }
        
        $tasks = Task::get_all();
        $this->response()->view('all_tasks', compact('tasks', 'task'));
    }

    public function action_delete() {
        if ($this->request->method() === 'GET') {
            $this->response()->redirect('tasks/list');
        }

        echo 'TaskController -> delete()<br>';
        echo'<br>';
        print_r($this->request->post());
        echo'<br>';

        
    }
}