<?php

namespace BrooksYang\Entrance\Facades;

use Illuminate\Support\Facades\Facade;

class Entrance extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'entrance';
    }
}
