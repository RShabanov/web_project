<?php

namespace App\Models;

use PDO;


class Auth extends BaseModel {
    protected static $table = 'users';

    protected static $attributes = [
        'name',
        'password'
    ];

    public $name, $password;

    protected function is_valid() {
        if (parent::is_valid()) {
            if (empty($this->name) || empty($this->password))
                $this->errors['authorization'] = 'Incorrect name or password';
            
            return !$this->has_errors();
        }
        return false;
    }

    public function match() {
        if (!empty($this->name) && !empty($this->password)) {
            $passw_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = static::get_db()->prepare('SELECT * FROM `' . static::$table . '` LIMIT 1;');
            if ($sql->execute()) {
                $user = $sql->fetch(PDO::FETCH_ASSOC);
                if (!empty($user)) {
                    $this->user_id = intval($user['id']);
                    return true;
                }
            }
        }
        return false;
    }
}

