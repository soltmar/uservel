<?php
return [
    'middlewares' => ['web'],
    'userModel' => \App\User::class,
    'routePrefix'=> '',
    'mainLayout' => 'uservel::layout',
    'displayProperties' => [
        'id', 'name', 'email', 'created_at', 'updated_at'
    ]
];
