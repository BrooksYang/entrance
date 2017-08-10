<?php

namespace BrooksYang\Entrance;

class Entrance
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Entrance constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->app->auth->user();
    }
}
