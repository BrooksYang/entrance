<?php

namespace BrooksYang\Entrance\Contracts;

interface RoleInterface
{
    /**
     * One-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();

    /**
     * Checks permission.
     *
     * @param $method
     * @param $uri
     * @return array|bool
     */
    public function hasPermission($method, $uri);

    /**
     * Many-to-Many relations with the permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions();
    
    /**
     * Save the inputted permissions.
     *
     * @param mixed $inputPermissions
     *
     * @return void
     */
    public function savePermissions($inputPermissions);
}
