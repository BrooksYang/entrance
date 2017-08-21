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
        $cachedKey = 'entrance_role_for_user_' . $this->$userPrimaryKey;

        return $cachedKey;
    }

    /**
     * get the Cache Key
     *
     * @return string
     */
    private function cachedMenuKey()
    {
        $userPrimaryKey = $this->primaryKey;
        $cachedKey = 'entrance_menu_for_user_' . $this->$userPrimaryKey;

        return $cachedKey;
    }

    /**
     * Big block of caching functionality.
     *
     * @return mixed
     */
    public function cachedRole()
    {
        $cachedKey = $this->cachedKey();

        return Cache::tags('role_users')->remember($cachedKey, config('session.lifetime'), function () {
            return $this->role;
        });
    }

    /**
     * Get the menus
     *
     * @return int
     */
    public function menus()
    {
        $cachedKey = $this->cachedMenuKey();

        return Cache::tags('user_menus')->remember($cachedKey, config('session.lifetime'), function () {

            // 获取该角色拥有的权限id，及所属模块id
            $permissions = $this->cachedRole()->permissions();
            $permissionIds = $permissions->pluck('id');
            $moduleIds = $permissions->distinct()->pluck('module_id');

            // 查询指定的可见permission
            $permissionQuery = function ($query) use ($permissionIds) {
                $query->where('is_visible', 1)->whereIn('id', $permissionIds);
            };

            // 查询指定的module
            $modulesQuery = function ($query) use ($moduleIds) {
                $query->whereIn('id', $moduleIds);
            };

            // 获取该角色可访问并且可见的权限菜单
            $group = config('entrance.group');
            $groups = $group::whereHas('modules.permissions', $permissionQuery)
                ->orWhereHas('permissions')
                ->with(['modules' => $modulesQuery, 'modules.permissions' => $permissionQuery, 'permissions'])
                ->orderBy('order')
                ->get();

            return $groups;
        });
    }

    /**
     * Get the breadcrumb
     *
     * @return mixed
     */
    public function breadcrumb()
    {
        $method = \Request::method();
        $uri = \Request::route()->uri();
        $permission = config('entrance.permission');

        return $permission::with(['module.group', 'group'])->where(['method' => $method, 'uri' => $uri])->first();
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
        Cache::tags('role_users')->flush();
        Cache::tags('user_menus')->flush();

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
        Cache::tags('role_users')->flush();
        Cache::tags('user_menus')->flush();

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
        Cache::tags('role_users')->flush();
        Cache::tags('user_menus')->flush();

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
