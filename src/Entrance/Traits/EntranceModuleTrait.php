<?php

namespace BrooksYang\Entrance\Traits;

use Illuminate\Support\Facades\Cache;

trait EntranceModuleTrait
{
    /**
     * Big block of caching functionality.
     *
     * @return mixed
     */
    public function cachedPermissions()
    {
        $modulePrimaryKey = $this->primaryKey;
        $cacheKey = 'entrance_permissions_for_module_' . $this->$modulePrimaryKey;

        return Cache::tags('module_permissions')->remember($cacheKey, config('session.lifetime'), function () {
            return $this->permissions()->get();
        });
    }

    /**
     * Flush cache when after inserts and updates
     *
     * @param array $options
     * @return mixed
     */
    public function save(array $options = [])
    {
        $result = parent::save($options);
        Cache::tags('module_permissions')->flush();

        return $result;
    }

    /**
     * Flush cache after deleting. Both soft or hard
     *
     * @param array $options
     * @return mixed
     */
    public function delete(array $options = [])
    {
        $result = parent::delete($options);
        Cache::tags('module_permissions')->flush();

        return $result;
    }

    /**
     * Flush cache when restoring soft deleting
     *
     * @return mixed
     */
    public function restore()
    {
        $result = parent::restore();
        Cache::tags('module_permissions')->flush();

        return $result;
    }

    /**
     * Many-to-Many relations with the permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->hasMany(config('entrance.permission'));
    }

    /**
     * Boot the role model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the role model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            if (!method_exists(config('entrance.role'), 'bootSoftDeletes')) {
                $role->users()->sync([]);
                $role->permissions()->sync([]);
            }

            return true;
        });
    }
}
