<?php

namespace BrooksYang\Entrance\Traits;

use Illuminate\Support\Facades\Cache;

trait EntranceUserTrait
{
    /**
     * get the Cache Key
     *
     * @return string
     */
    private function cachedKey()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'entrance_role_for_user_' . $this->$userPrimaryKey;

        return $cacheKey;
    }

    /**
     * Big block of caching functionality.
     *
     * @return mixed
     */
    public function cachedRole()
    {
        $cacheKey = $this->cachedKey();

        return Cache::tags(config('entrance.role_user'))->remember($cacheKey, config('session.lifetime'), function () {
            return $this->role;
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
        Cache::tags(config('entrance.role_user'))->flush();

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
        Cache::tags(config('entrance.role_user'))->flush();

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
        Cache::tags(config('entrance.role_user'))->flush();

        return $result;
    }

    /**
     * One-to-Many relation with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(config('entrance.role'));
    }

    /**
     * check if the user is super administrator.
     *
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->id == 1;
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
        if ($this->isAdministrator()) return true;

        $role = $this->cachedRole();

        if (empty($role)) return false;

        return $role->hasPermission($method, $uri);
    }

    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if (!method_exists(config('auth.model'), 'bootSoftDeletes')) {
                $user->roles()->sync([]);
            }

            return true;
        });
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->role()->attach($role);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->role()->detach($role);
    }
}
