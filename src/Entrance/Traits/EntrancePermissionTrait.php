<?php

namespace BrooksYang\Entrance\Traits;

trait EntrancePermissionTrait
{
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('entrance.role'), config('entrance.permission_role_table'));
    }

    /**
     * One-to-Many relations with module model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(config('entrance.module'));
    }

    /**
     * Boot the permission model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the permission model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($permission) {
            if (!method_exists(config('entrance.permission'), 'bootSoftDeletes')) {
                $permission->roles()->sync([]);
            }

            return true;
        });
    }

    /**
     * Get visible permissions.
     *
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', 1);
    }
}
