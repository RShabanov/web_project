<?php

namespace App\Models;

use PDO;


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
        'user_id',
        'deleted'
    ];

    public $name, $type_id,
        $location, $time, 
        $duration, $text, 
        $status_id, $user_id, $deleted = false;

    protected static $table = 'tasks';

    public function is_valid() {
        if (parent::is_valid()) {
            # code...
            
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
}