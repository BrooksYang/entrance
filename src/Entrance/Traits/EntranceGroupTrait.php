<?php

namespace BrooksYang\Entrance\Traits;

trait EntranceGroupTrait
{
    /**
     * One-to-Many relations with the module model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->hasMany(config('entrance.module'));
    }

    /**
     * One-to-Many relations with the module model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->hasMany(config('entrance.permission'));
    }
}
