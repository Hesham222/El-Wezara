<?php

use Illuminate\Database\Seeder;
use Admin\Models\RolePermission;
use Admin\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        RolePermission::create([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        Admin::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'phone' => '0101111002', 'password' => bcrypt(1234567890), 'role_id' => 1]);
    }
}
