<?php

namespace BrooksYang\Entrance;

use Illuminate\Console\Command;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'entrance:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the Entrust specifications.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel->view->addNamespace('entrance', substr(__DIR__, 0, -8).'views');

        $rolesTable          = config('entrance.roles_table');
        $permissionsTable    = config('entrance.permissions_table');
        $permissionRoleTable = config('entrance.permission_role_table');
        $modulesTable        = config('entrance.modules_table');
        $groupsTable         = config('entrance.groups_table');

        $this->info("Tables: $rolesTable, $permissionsTable, $permissionRoleTable, $modulesTable, $groupsTable");

        $message = "A migration that creates '$rolesTable', '$permissionsTable', '$permissionRoleTable', '$modulesTable', '$groupsTable'" .
            " tables will be created in database/migrations directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {

            $this->line('');

            $this->info("Creating migration...");
            if ($this->createMigration($rolesTable, $permissionsTable, $permissionRoleTable, $modulesTable, $groupsTable)) {

                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissions" .
                    " within the database/migrations directory."
                );
            }

            $this->line('');
        }
    }

    /**
     * Create the migration.
     *
     * @param $rolesTable
     * @param $permissionsTable
     * @param $permissionRoleTable
     * @param $modulesTable
     * @param $groupsTable
     * @return bool
     */
    protected function createMigration($rolesTable, $permissionsTable, $permissionRoleTable, $modulesTable, $groupsTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_entrance_setup_tables.php";

        $userModel = config('auth.providers.users.model');
        $userModel = new $userModel;
        $usersTable  = $userModel->getTable();

        $data = compact('rolesTable', 'permissionsTable', 'permissionRoleTable', 'modulesTable', 'groupsTable', 'usersTable');

        $output = $this->laravel->view->make('entrance::generators.migration')->with($data)->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}
