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
use Illuminate\Support\ServiceProvider;
use View;

class UservelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register Routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'uservel');

        View::composer('uservel::alert', function ($view) {
            $alerts = session('laralert');
            $view->with('alerts', $alerts);
        });

        Blade::if('notempty', function ($item) {
            return !empty($item);
        });
    }

    public function register()
    {

        $this->mergeConfigFrom(
            __DIR__.'/../config/uservel.php', 'uservel'
        );

        // Check if user have already defined 'User" facade
        if (!class_exists('User')) {
            //If not register User alias pointing to User model
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('User', config('uservel.userModel'));
        }

        if (!is_subclass_of('User', Model::class)) {
            throw new \UnexpectedValueException('Uservel requires "User" alias to be pointing to your eloquent user model');
        }

    }

}