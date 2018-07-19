<?php

namespace BrooksYang\Entrance;

use BrooksYang\Entrance\Middleware\EntrancePermission;
use BrooksYang\Entrance\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class EntranceServiceProvider extends ServiceProvider
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
            'auth.guards.admin.driver'    => config('entrance.guards.admin.driver'),
            'auth.guards.admin.provider'  => config('entrance.guards.admin.provider'),
            'auth.providers.admin.driver' => config('entrance.providers.admin.driver'),
            'auth.providers.admin.model'  => config('entrance.providers.admin.model'),
        ]);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__ . '/../../config/entrance.php' => config_path('entrance.php'),
        ], 'entrance');

        // Register the commands.
        $this->commands('entrance.migration');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the application bindings.
        $this->app->bind('entrance', function ($app) {
            return new Entrance($app);
        });

        // Register the alias.
        $this->app->alias('entrance', 'BrooksYang\Entrance\Entrance');

        // Register the artisan commands.
        $this->app->singleton('entrance.migration', function () {
            return new InstallCommand();
        });

        // Default Package Configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/entrance.php', 'entrance'
        );

        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        if (is_null(config('auth.guards.admin'))) {
            $this->setupAuth();
        }
    }
}
