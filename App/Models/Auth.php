<?php

namespace App\Models;

use PDO;


class Auth extends BaseModel {
    protected static $table = 'users';

    protected static $attributes = [
        'name',
        'password'
    ];

    public $user_id;

    protected function is_valid() {
        if (parent::is_valid()) {
            if (empty($this->name) || empty($this->password))
                $this->errors['authorization'] = 'All fields must be filled';
            
            return !$this->has_errors();
        }
        return false;
    }

    public function match() {
        if ($this->is_valid()) {
            $set = [
                ':name' => $this->name
            ];

            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$table . '` WHERE `name`=:name LIMIT 1;');
            if ($sql->execute($set)) {
                $user = $sql->fetch(PDO::FETCH_ASSOC);
                if (!empty($user)) {
                    if (password_verify($this->password, $user['password'])) {
                        $this->user_id = intval($user['id']);
                        return true;
                    }
                    else {
                        $this->errors['authorization'] = 'Incorrect name or password';
                    }
                }
                else {
                    $this->errors['authorization'] = 'Incorrect name or password';
                }
            }
        }
        return false;
    }
}

