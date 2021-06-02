<?php

// for view
// <input type="datetime-local" >
// <input type="time">

use App\Components\Router;


ini_set('display_errors', '1');
error_reporting(E_ALL);


define('ROOT', dirname(__FILE__));
require_once ROOT . '/App/Components/Router.php';
require_once ROOT . '/App/Controllers/BaseController.php';
require_once ROOT . '/App/Models/BaseModel.php';


$router = new Router;
$router->run();
