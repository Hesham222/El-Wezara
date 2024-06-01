<?php

use Illuminate\Database\Seeder;
use Admin\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'All-Modules'
        ]);

        Permission::create([
            'name' => 'Dashboard-Module'
        ]);

        Permission::create([
            'name' => 'Admin-Module'
        ]);

        Permission::create([
            'name' => 'Admin-Add'
        ]);

        Permission::create([
            'name' => 'Admin-Edit'
        ]);

        Permission::create([
            'name' => 'Admin-View'
        ]);

        Permission::create([
            'name' => 'Admin-Delete'
        ]);

        Permission::create([
            'name' => 'Admin-Change-Password'
        ]);

        Permission::create([
            'name' => 'Organization-Module'
        ]);

        Permission::create([
            'name' => 'Organization-Add'
        ]);

        Permission::create([
            'name' => 'Organization-Edit'
        ]);

        Permission::create([
            'name' => 'Organization-View'
        ]);

        Permission::create([
            'name' => 'Organization-Delete'
        ]);
    }
}
