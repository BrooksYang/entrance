<?php

namespace BrooksYang\Entrance;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class EntranceAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../../Admin/routes/entrance.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../Admin/views', 'entrance');

        // Publish assets
        $this->publishes([
            __DIR__ . '/../../Admin/assets' => public_path('assets')
        ], 'public');

        // Validation Rules
        $this->validatorRules();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Validation Rules
     */
    public function validatorRules()
    {
        Validator::extend('permission', function($attribute, $value, $parameters, $validator) {
            $method = $parameters[0];
            $uri = $parameters[1];
            $id = $parameters[2];
            $permission = config('entrance.permission');

            return !$permission::where(['method' => $method, 'uri' => $uri])->where('id', '<>', $id)->exists();
        }, '该权限已存在');
    }
}
