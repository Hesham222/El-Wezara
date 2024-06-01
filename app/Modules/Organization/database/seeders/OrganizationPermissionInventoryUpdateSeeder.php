<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Permission;

class OrganizationPermissionInventoryUpdateSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //inventory
        Permission::where('id',13)->update([
            'name'    => 'Maghzn',
        ]);
        Permission::where('id',477)->update([
            'name'    => 'MaghznPo-check',
        ]);
        Permission::where('id',478)->update([
            'name'    => 'MaghznPo-order',
        ]);
        Permission::where('id',479)->update([
            'name'    => 'MaghznPo-receive',
        ]);


    }
}
