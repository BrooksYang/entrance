<?php

namespace BrooksYang\Entrance\Contracts;

interface ModuleInterface
{
    /**
     * One-to-Many relations with permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function permissions();
}
