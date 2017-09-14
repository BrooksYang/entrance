<?php

namespace BrooksYang\Entrance\Commands;

use BrooksYang\Entrance\Database\EntranceTablesSeeder;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'entrance:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the entrance package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->publishDatabase();
    }

    /**
     * Create tables and seed it.
     */
    public function publishDatabase()
    {
        $this->call('migrate', ['--path' => str_replace(base_path(), '', __DIR__) . '/../database/migrations']);

        $this->info('Seeding...');
        $this->call('db:seed', ['--class' => EntranceTablesSeeder::class]);
        $this->comment('Seeded.');
    }
}
