<?php
return [
    // Middleware used by package
    'middlewares' => ['web'],

    // User model class
    'userModel' => \App\User::class,

    'route' => 'user',

    // Route prefix for uservel module
    'routePrefix'=> '',

    // Main layout blade file ( must have 'yield("content")' in it)
    'mainLayout' => 'uservel::layout',

    // Properties displayed in user list table
    'displayProperties' => [
        'name', 'email', 'created_at', 'updated_at'
    ],

    /**
     * Any checked non-existing permissions will be auto-added to database
     * Due to querying every single check this should be used in development only ,
     * when creating permissions and roles hierarchy
     */

    'autoadd' => true
];
