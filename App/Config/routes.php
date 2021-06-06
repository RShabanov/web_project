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
    // '/tasks/add' => [
    //     'controller' => 'task',
    //     'action' => 'add'
    // ],
    // '/tasks/update' => [
    //     'controller' => 'task',
    //     'action' => 'update'
    // ],
    '/tasks/save' => [
        'controller' => 'task',
        'action' => 'save'
    ],
    '/login' => [
        'controller' => 'auth',
        'action' => 'login'
    ]
);