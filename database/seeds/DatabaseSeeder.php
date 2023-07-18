<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([ProcedureTypeTableSeeder::class]);
        $this->call([AboutTableSeeder::class]);
        $this->call([StatusTableSeeder::class]);
        $this->call([LastNewsTableSeeder::class]);
        $this->call([SectionsTableSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([RolesTableSeeder::class]);
        $this->call([GroupsTableSeeder::class]);
        \Illuminate\Support\Facades\Artisan::call('passport:install');
    }
}
