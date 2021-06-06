<?php

namespace App\Models;

use PDO;

use App\Session;


class Task extends BaseModel {
    private static $types_table = 'task_types';
    private static $statuses_table = 'task_statuses';
    protected static $table = 'tasks';

    protected static $task_types = [];

    protected static $task_statuses = [];

    protected static $attributes = [
        'name',
        'type_id',
        'location',
        'time',
        'duration',
        'comment',
        'status_id',
        'user_id',
        'deleted'
    ];

    protected function is_valid() {
        if (parent::is_valid()) {
            if (empty($this->name)) {
                $this->errors['name'] = 'Task name cannot be empty';
            }
            if (empty($this->type_id)) {
                $this->errors['type_id'] = 'There must be any task type';
            }
            if (empty($this->time)) {
                $this->errors['time'] = 'Task must have date and time';
            }
            if (empty($this->duration)) {
                $this->errors['duration'] = 'Task must have duration';
            }
            if (empty($this->time)) {
                $this->errors['time'] = 'Task must have date and time';
            }
            
            return !$this->has_errors();
        }
        return false;
    }

    public static function get_types() {
        if (empty(static::$task_types)) {
            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$types_table . '` ORDER BY `id` ASC;');
            if ($sql->execute()) {
                while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                    static::$task_types[$row['id']] = $row['name'];
            }
        }
        return static::$task_types;
    }

    public static function get_statuses() {
        if (empty(static::$task_statuses)) {
            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$statuses_table . '` ORDER BY `id` ASC;');
            if ($sql->execute())
                while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                    static::$task_statuses['id'] = $row['name'];
        }
        return static::$task_statuses;
    }

    public function fill($array) {
        parent::fill($array);
        
        if (empty($this->user_id))
            $this->user_id = Session::get('user_id');
        if (empty($this->status_id))
            $this->status_id = 1;
        if (empty($this->deleted))
            $this->deleted = 0;
    }
}