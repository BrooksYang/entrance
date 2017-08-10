<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntranceSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('{{ $rolesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('role name');
            $table->string('description')->nullable()->comment('A more detailed explanation of what the Role does.');
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create('{{ $permissionsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('permission name');
            $table->string('description')->nullable()->comment('A more detailed explanation of the Permission.');
            $table->string('method');
            $table->string('uri');
            $table->integer('module_id')->defalut(1)->unsigned();
            $table->tinyInteger('is_visible')->defalut(1)->unsigned()->comment('is visible in module, 0not 1yes');
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('{{ $permissionRoleTable }}', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->primary(['permission_id', 'role_id']);
        });

        // Create table for storing modules
        Schema::create('{{ $modulesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('module name');
            $table->string('icon',255);
            $table->string('description')->nullable()->comment('A more detailed explanation of the module.');
            $table->timestamps();
        });

        // add role_id to users table
        Schema::table('{{ $usersTable }}', function (Blueprint $table) {
            if (!Schema::hasColumn('{{ $usersTable }}', 'role_id')) {
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
        Schema::drop('{{ $permissionRoleTable }}');
        Schema::drop('{{ $permissionsTable }}');
        Schema::drop('{{ $rolesTable }}');
        Schema::drop('{{ $modulesTable }}');
    }
}
