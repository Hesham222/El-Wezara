<?php

use Illuminate\Database\Seeder;
use Admin\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin'
        ]);

        Role::create([
            'name' => 'Organization Admin'
        ]);

        Role::create([
            'name' => 'Organization Viewer'
        ]);
    }
}
