<?php

namespace BrooksYang\Entrance;

use BrooksYang\Entrance\Middleware\EntrancePermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EntranceAdminServiceProvider extends ServiceProvider
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'entrance' => EntrancePermission::class,
    ];

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function setupAuth()
    {
        config([
            'auth.guards.admin.driver'    => 'session',
            'auth.guards.admin.provider'  => 'admin',
            'auth.providers.admin.driver' => 'eloquent',
            'auth.providers.admin.model'  => config('entrance.user'),
        ]);
    }

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
            __DIR__ . '/../../Admin/assets' => public_path('vendor/entrance'),
        ], 'entrance');

        // Publish Views
        $this->publishes([
            __DIR__.'/../../Admin/views' => resource_path('views/vendor/entrance'),
        ], 'entrance.views');

        // Breadcrumb View Share
        View::composer(['entrance::layouts.include.breadcrumb', 'entrance::layouts.include.side_menu'], function ($view) {
            $view->with('breadcrumb', \Auth::user()->breadcrumb());
        });

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
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        if (is_null(config('auth.guards.admin'))) {
            $this->setupAuth();
        }
    }

    /**
     * Validation Rules
     */
    public function validatorRules()
    {
        Validator::extend('permission', function ($attribute, $value, $parameters, $validator) {
            $method = $parameters[0];
            $uri = $parameters[1];
            $id = $parameters[2];
            $permission = config('entrance.permission');

            return !$permission::where(['method' => $method, 'uri' => $uri])->where('id', '<>', $id)->exists();
        }, '该权限已存在');
    }
}
