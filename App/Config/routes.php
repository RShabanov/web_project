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
    '/create-account' => [
        'controller' => 'register',
        'action' => 'create_account'
    ],
);