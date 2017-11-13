<?php
return [
    // Middleware used by package
    'middlewares' => ['web'],

    // User model class
    'userModel' => \App\User::class,

    // Route prefix for uservel module
    'routePrefix'=> '',

    // Main layout blade file ( must have 'yield("content")' in it)
    'mainLayout' => 'uservel::layout',

    // Properties displayed in user list table
    'displayProperties' => [
        'name', 'email', 'created_at', 'updated_at'
    ]
];
