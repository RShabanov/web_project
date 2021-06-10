<?php

namespace App\Models;

use PDO;


class Register extends BaseModel {
    protected static $table = 'users';

    protected static $attributes = [
        'name',
        'password',
        'password_confirm'
    ];

    public $user_id;

    public function is_valid() {
        if (parent::is_valid()) {
            if (empty($this->name) || 
                empty($this->password) || 
                empty($this->password_confirm)) {
                    $this->errors['registration'] = 'All fields must be filled';
                }
            if (isset($this->password) && isset($this->password_confirm) &&
                $this->password !== $this->password_confirm) {
                    $this->errors['registration'] = 'Passwords must match';
                }
               
            return !$this->has_errors();
        }
        return false;
    }

    public function create_account() {
        if ($this->is_valid()) {
            $attrs = ['name', 'password'];

            $sql = static::get_db()->prepare('INSERT INTO `' . static::$table . '` (`' . implode('`, `', $attrs) . '`) VALUES (:' . implode(', :', $attrs) . ');');

            $data = [];
            foreach ($attrs as $attribute) {
                if ($attribute === 'password')
                    $data[$attribute] = password_hash($this->$attribute, PASSWORD_DEFAULT);
                else 
                    $data[$attribute] = $this->$attribute;
            }

            if ($sql->execute($data)) {
                return true;
            }
            else {
                print_r($sql->errorInfo());
                $this->errors['registration'] = 'The user with this name already exists';
            }

        }
        return false;
    }
}