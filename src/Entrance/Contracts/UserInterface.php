<?php

namespace BrooksYang\Entrance\Contracts;

interface UserInterface
{
    /**
     * One-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role();

    /**
     * check if the user is super administrator.
     *
     * @return mixed
     */
    public function isAdministrator();

    /**
     * Checks permission.
     *
     * @param $method
     * @param $uri
     * @return array|bool
     */
    public function hasPermission($method, $uri);

    /**
     * Alias to eloquent one-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role);

    /**
     * Alias to eloquent one-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role);
}
