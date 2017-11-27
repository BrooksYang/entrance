<?php

return [

    // Admin tables and model.
    'users_table' => 'auth_admins',
    'user' => BrooksYang\Entrance\Models\Administrator::class,

    // Role tables and model.
    'roles_table' => 'auth_roles',
    'role' => BrooksYang\Entrance\Models\Role::class,

    // Permission tables and model.
    'permissions_table' => 'auth_permissions',
    'permission' => BrooksYang\Entrance\Models\Permission::class,

    // Module tables and model.
    'modules_table' => 'auth_modules',
    'module' => BrooksYang\Entrance\Models\Module::class,

    // Group tables and model.
    'groups_table' => 'auth_groups',
    'group' => BrooksYang\Entrance\Models\Group::class,

    // Pivot table.
    'permission_role_table' => 'auth_permission_role',
];
