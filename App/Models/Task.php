<?php

namespace App\Models;


class Task extends BaseModel {
    private static $types_table = 'task_types';
    
    private static $statuses_table = 'task_statuses';

    protected static $task_types = [];

    protected static $task_statuses = [];

    protected static $attributes = [
        'name',
        'type_id',
        'location',
        'time',
        'duration',
        'text',
        'status_id',
        'user_id'
    ];

    protected static $table = 'tasks';

    public function is_valid() {
        if (parent::is_valid()) {
            # code...
            
            return !$this->has_errors();
        }
        return false;
    }

    public function get_types() {
        if (empty(static::$task_types)) {
            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$types_table . '`;');
            static::$task_types = $sql->execute()->fetch(PDO::FETCH_ASSOC);
        }
        return static::$task_types;
    }

    public function get_statuses() {
        if (empty(static::$task_statuses)) {
            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$statuses_table . '`;');
            static::$task_statuses = $sql->execute()->fetch(PDO::FETCH_ASSOC);
        }
        return static::$task_statuses;
    }
}