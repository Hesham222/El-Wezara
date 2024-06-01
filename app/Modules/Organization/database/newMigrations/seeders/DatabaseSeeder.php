<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PermissionSeeder;
use RoleSeeder;
use AdminSeeder;
use SatauesSeeder;
use ServiceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        //$this->call(RoleSeeder::class);
        //$this->call(AdminSeeder::class);
        //$this->call(ServiceSeeder::class);
        //$this->call(SatauesSeeder::class);
        //\App\Models\User::factory(10)->create();
    }
}
