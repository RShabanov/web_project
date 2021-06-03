<?php

namespace App\Models;

use App\Db\Database;


class BaseModel {
    public $user_id;

    protected static $table;
    protected static $attributes = [];

    protected $errors = [];

    private function is_valid() {
        return isset($this->table) && isset($this->id);
    }

    public function save() {
        if ($this->is_valid()) {
            $sql = static::get_db()->prepare('INSERT INTO `' . static::$table . '` (`' . implode('`, `', static::$attributes) . '`) VALUES (:' . implode(', :', static::$attributes) . ');');

            $data = [];

            foreach (static::$attributes as $attribute) {
                $data[$attribute] = $this->$attribute;
            }

            $sql->execute($data);

            return $sql->rowCount() === 1;
        }
        return false;
    }

    public function update() {
        if ($this->is_valid()) {
            $set = [];

            foreach (static::$attributes as $attribute) {
                $set[] = '`' . $attribute . '` = :' . $attribute;
            }

            $sql = static::get_db()->prepare('UPDATE `' . static::$table . '` SET ' . implode(', ', $set) . '`) WHERE id = :id LIMIT 1;');

            $data = [];

            foreach (static::$attributes as $attribute) {
                $data[$attribute] = $this->$attribute;
            }

            $data['id'] = $this->id;

            $sql->execute($data);

            return $sql->errorInfo();
        }
        return false;
    }

    public function delete() {
        if ($this->is_valid()) {
            $sql = static::get_db()->prepare('DELETE FROM `' . static::$table . '` WHERE id = :id LIMIT 1;');

            $data = [];
            $data['id'] = $this->id;

            $sql->execute($data);

            // return $sql->errorInfo();
        }
    }

    public function get_all() {
        $sql = static::get_db()->prepare('SELECT * FROM `' . static::$table . '`;');
        $sql->execute();

        $objects = [];

        while ($object = $sql->fetchObject(static::class)) {
            $objects[] = $object;
        }

        return $objects;
    }

    public function get_by_id() {
        $sql = static::get_db()->prepare('SELECT * FROM `' . static::$table . '` WHERE id = :id LIMIT 1;');
        $sql->execute(['id' => $id]);
        $object = $sql->fetchObject(static::class);
        return $object;
    }

    public function get_errors() {
        return $this->errors;
    }

    public function has_errors() {
        return !empty($this->errors);
    }

    public static function get_db() {
        require_once ROOT . '/App/Database/Database.php';
        return Database::get_pdo();
    }

    public function fill($array) {
        foreach (static::$attributes as $attribute) {
            $this->$attribute = array_get($array, $attribute);
        }
    }

}