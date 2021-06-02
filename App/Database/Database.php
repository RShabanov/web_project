<?php

namespace App\Db;

use PDO;


class Database {
    protected static $pdo;

    public static function get_pdo() {
        if (empty(static::$pdo)) {
            $config = require_once ROOT . '/App/Config/db.php';

            static::$pdo = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'], $config['user'], $config['password']);
        }
        return static::$pdo;
    }
}