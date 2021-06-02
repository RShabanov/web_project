<?php

namespace App\Controllers;

require_once ROOT . '/App/Models/Task.php';
use App\Models\Task;


class TaskController extends BaseController {
    public function action_show() {
        echo 'TaskController -> action_show()<br>';

        $task = new Task;
        print_r($task->get_types());
    }

    public function action_index($id) {
        echo 'TaskController -> action_index()<br>';
        
        $task = new Task;
    }
}