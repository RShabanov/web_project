<?php

namespace App\Controllers;

use App\Models\Task;

use App\Request;


class TaskController extends BaseController {
    public function action_show() {
        $tasks = Task::get_all();
        $this->response()->view('all_tasks', compact('tasks'));
    }

    public function action_save() {
        if ($this->request->method() === 'GET') {
            $this->response()->redirect('tasks/list');
        }
        else {
            $task = new Task;
            $task->fill($this->request->post());
            if (!empty($this->request->post()['id']))
                $task->id = $this->request->post()['id'];

            $method = isset($task->id) ? 'update' : 'save';

            if ($task->$method()) {
                $this->response()->get_back();
            }
            
            $tasks = Task::get_all();
            $this->response()->view('all_tasks', compact('tasks', 'task'));
        }
    }

    public function action_delete() {
        if ($this->request->method() === 'GET') {
            $this->response()->redirect('tasks/list');
        }
        else {
            Task::delete_group($this->request->post());
            $this->response()->get_back();
        }
    }
}