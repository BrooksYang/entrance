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

Route::group(['middleware' => ['web'], 'namespace' => 'BrooksYang\Entrance\Controllers'], function () {

    // Demo
    Route::get('demo', function () {
        return view('entrance::entrance.index');
    })->middleware(['web', 'auth']);

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});
