<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PermissionSeeder;
use RoleSeeder;
use AdminSeeder;
use ServiceSeeder;
use SatauesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);*/
	    $this->call(SatauesSeeder::class);
        //$this->call(ServiceSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
