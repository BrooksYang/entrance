<?php

Route::group(['prefix' => 'auth', 'middleware' => ['web', 'auth', 'permission'], 'namespace' => 'BrooksYang\Entrance\Controllers'], function () {

    // Groups
    Route::resource('groups', 'GroupController');

    // Group order
    Route::get('groups/{group}/move/{action}', 'GroupController@move');

    // Modules
    Route::resource('modules', 'ModuleController');

    // Permissions
    Route::resource('permissions', 'PermissionController');

    // Roles
    Route::resource('roles', 'RoleController');

    // Show the Assign Permissions form
    Route::get('roles/{role}/permissions', 'RoleController@permissions');

    // Assign Permissions
    Route::post('roles/{role}/permissions', 'RoleController@permissionsSync');

    // Users
    Route::resource('users', 'UserController');

});