<?php

return array(
    '/' => [
        'controller' => 'task',
        'action' => 'show'
    ],
    '/tasks/list' => [
        'controller' => 'task',
        'action' => 'show'
    ],
    '/tasks/delete' => [
        'controller' => 'task',
        'action' => 'delete'
    ],
    '/tasks/save' => [
        'controller' => 'task',
        'action' => 'save'
    ],
    '/login' => [
        'controller' => 'auth',
        'action' => 'login'
    ],
    '/logout' => [
        'controller' => 'auth',
        'action' => 'logout'
    ],
    '/create_account' => [
        'controller' => 'register',
        'action' => 'create_account'
    ],
);