<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntranceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create(config('entrance.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('role name');
            $table->string('description')->nullable()->comment('A more detailed explanation of what the Role does.');
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create(config('entrance.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('permission name');
            $table->string('description')->nullable()->comment('A more detailed explanation of the Permission.');
            $table->string('method');
            $table->string('uri');
            $table->integer('module_id')->unsigned()->default(0);
            $table->integer('group_id')->nullable()->default(0);
            $table->string('icon', 64)->nullable();
            $table->boolean('is_visible')->default(1)->comment('is visible in module, 0not 1yes');
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create(config('entrance.permission_role_table'), function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->primary(['permission_id', 'role_id']);
        });

        // Create table for storing modules
        Schema::create(config('entrance.modules_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('module name');
            $table->string('description')->nullable()->comment('A more detailed explanation of the module.');
            $table->string('icon');
            $table->integer('group_id');
            $table->timestamps();
        });

        // Create table for storing modules
        Schema::create(config('entrance.groups_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('group name');
            $table->string('description')->nullable()->comment('A more detailed explanation of the group.');
            $table->integer('order')->unsigned()->nullable()->comment('The order of the group');
            $table->timestamps();
        });

        // add role_id to users table
        $userModel = config('auth.providers.users.model');
        $userModel = new $userModel;
        $usersTable = $userModel->getTable();
        Schema::table($usersTable, function (Blueprint $table) use ($usersTable) {
            if (!Schema::hasColumn($usersTable, 'role_id')) {
                $table->integer('role_id')->nullable()->comment('role_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('entrance.permission_role_table'));
        Schema::dropIfExists(config('entrance.permissions_table'));
        Schema::dropIfExists(config('entrance.roles_table'));
        Schema::dropIfExists(config('entrance.modules_table'));
        Schema::dropIfExists(config('entrance.groups_table'));
    }
}
