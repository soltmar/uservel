<?php
/**
 *
 * Project: uservel
 * Date: 05/10/2017
 * @author Mariusz Soltys.
 * @version 1.0.0
 * @license All Rights Reserved
 *
 */

namespace marsoltys\uservel;

use Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use marsoltys\uservel\Console\SuperAdmin;
use marsoltys\uservel\Policies\UserPolicy;
use marsoltys\uservel\Providers\AuthServiceProvider;
use View;

class UservelServiceProvider extends ServiceProvider
{
    protected $commands = [
        SuperAdmin::class
    ];


    public function boot(Router $router)
    {

        // Register policy
        Gate::policy(\User::class, UserPolicy::class);

        // Register Spatie Middlewares if package exists
        if (class_exists(\Spatie\Permission\Middlewares\RoleMiddleware::class)) {
            $router->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
            $router->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
        }

        //Register Console Commands
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
            $this->publishes([
                __DIR__ . '/../resources/css' => public_path('vendor/marsoltys/uservel'),
            ], 'public');
        }

        // Register Routes
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        // Load Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'uservel');

        // Load Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        View::composer('uservel::includes.alert', function ($view) {
            $alerts = session('laralert');
            $view->with('alerts', $alerts);
        });

        Blade::if ('notempty', function ($item) {
            return !empty($item);
        });

        //Checks if spatie/laravel-permissions package has been installed
        Blade::if ('permissions', function () {
            return class_exists('\Spatie\Permission\PermissionServiceProvider');
        });
    }

    public function register()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/../config/uservel.php', 'uservel'
        );

        // Check if user have already defined 'User" facade/alias
        if (!class_exists('User')) {
            //If not register User alias pointing to User model
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('User', config('uservel.userModel'));
        }

        if (!is_subclass_of('User', Model::class)) {
            throw new \UnexpectedValueException('Uservel requires "userModel" config property to be pointing to your eloquent user model');
        }

        //Register Service Providers
        $this->app->register(AuthServiceProvider::class);

    }

}