<?php

namespace BrooksYang\Entrance;

use BrooksYang\Entrance\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class EntranceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__.'/../../config/entrance.php' => config_path('entrance.php'),
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
    }
}
