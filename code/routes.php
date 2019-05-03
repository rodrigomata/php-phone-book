<?php
/**
 * routes
 * :: Routes are defined here depending on the HTTP method
 */

return [
    'GET' => [
        'api/users' => 'UserController@list',
        'api/users/:id' => 'UserController@show',
    ],
    'POST' => [
        'api/users' => 'UserController@store',
    ],
    'PATCH' => [
        'api/users' => 'UserController@update',
    ],
    'DELETE' => [
        'api/users' => 'UserController@delete',
    ]
]

?>