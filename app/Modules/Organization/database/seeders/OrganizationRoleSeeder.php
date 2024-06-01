<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Role;

class OrganizationRoleSeeder extends Seeder
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
    }
}
