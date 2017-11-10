<?php

$namespace = 'marsoltys\uservel\Controllers';

/**
 * Admin panel routes.
 */
Route::namespace($namespace)
    ->middleware(config('uservel.middlewares'))
    ->prefix(config('uservel.routePrefix'))
    ->group(function () {

        if (class_exists('\Spatie\Permission\PermissionServiceProvider')) {
            Route::resources([
                'user/role'       => 'RoleController',
                'user/permission' => 'PermissionController'
            ]);
        }

        Route::delete('user', 'UserController@index');
        Route::resource('user', 'UserController');
    });
