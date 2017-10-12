<?php

$namespace = 'marsoltys\uservel\Controllers';

/**
* Admin panel routes.
*/
Route::namespace($namespace)
    ->middleware(config('uservel.middlewares'))
    ->prefix(config('uservel.routePrefix'))
    ->group(function () {

        Route::resource('user', 'UserController');

});
