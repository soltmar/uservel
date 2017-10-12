<?php
return [
    'middlewares' => ['web'],
    'userModel' => \App\User::class,
    'routePrefix'=> '',
    'mainLayout' => 'layouts.app',
    'displayProperties' => [
        'id', 'name', 'email', 'created_at', 'updated_at'
    ]
];
