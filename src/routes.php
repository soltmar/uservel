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

        Route::delete(config('uservel.route'), 'UserController@index')->name(config('uservel.route').'.index');
        Route::resource(config('uservel.route'), 'UserController');
    });
