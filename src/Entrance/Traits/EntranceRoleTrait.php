<?php

namespace BrooksYang\Entrance\Traits;

use Illuminate\Support\Facades\Cache;

trait EntranceRoleTrait
{
    /**
     * get the Cache Key
     *
     * @return string
     */
    private function cachedKey()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'entrance_permissions_for_role_' . $this->$rolePrimaryKey;

        return $cacheKey;
    }

    /**
     * Big block of caching functionality.
     *
     * @return mixed
     */
    public function cachedPermissions()
    {
        $cacheKey = $this->cachedKey();

        return Cache::tags('role_permissions')->remember($cacheKey, config('entrance.cache_ttl'), function () {
            return $this->permissions()->get();
        });
    }

    /**
     * Flush cache after inserts and updates
     *
     * @param array $options
     * @return mixed
     */
    public function save(array $options = [])
    {
        $result = parent::save($options);
        Cache::tags('role_permissions')->flush();

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
        Cache::tags('role_permissions')->flush();

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
        Cache::tags('role_permissions')->flush();

        return $result;
    }

    /**
     * Flush cache when attaching a model to the parent.
     *
     * @param  mixed  $id
     * @param  array  $attributes
     * @param  bool   $touch
     * @return void
     */
    public function attach($id, array $attributes = [], $touch = true)
    {
        parent::attach($id, $attributes, $touch);

        Cache::tags('role_permissions')->flush();
        Cache::tags('role_users')->flush();
        Cache::tags('user_menus')->flush();
    }

    /**
     * One-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->hasMany(config('auth.providers.users.model'));
    }

    /**
     * Many-to-Many relations with the permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(config('entrance.permission'), config('entrance.permission_role_table'));
    }

    /**
     * Check if user has a permission by the request method and uri.
     *
     * @param $method
     * @param $uri
     * @return bool
     */
    public function hasPermission($method, $uri)
    {
        $cacheKey = $this->cachedKey();

        $permissions = Cache::tags('role_permissions')->remember($cacheKey, config('entrance.cache_ttl'), function () use ($method, $uri) {
            return $this->permissions()->get();
        });

        $permission = $permissions->first(function ($permission) use ($method, $uri) {
            return $permission->method == $method && $permission->uri == $uri;
        });

        return (bool) $permission;
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
                $role->permissions()->sync([]);
            }

            return true;
        });
    }

    /**
     * Save the inputted permissions and flush cache.
     *
     * @param $inputPermissions
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }

        Cache::tags('role_permissions')->flush();
        Cache::tags('role_users')->flush();
        Cache::tags('user_menus')->flush();
    }
}
