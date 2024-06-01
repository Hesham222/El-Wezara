<?php
namespace Admin\Actions\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Organization\Models\OrganizationAdmin;
use Organization\Models\RolePermission;

class AssignDatabaseAction
{
    public function execute(Request $request, $record)
    {
        $organization = $record->id;
        // create organization_ database.
        DB::statement('DROP DATABASE IF EXISTS organization_' . $organization);
        DB::statement('create database organization_' . $organization . ' CHARACTER SET utf8 COLLATE utf8_general_ci');
        //Change the default DB configration to the new database created for an organization.
        Config::set('database.connections.organization', [
            'driver'     => 'mysql',
            'host'       => config('database.connections.mysql.host'),
            'database'   => 'organization_' . $organization,
            'username'   => config('database.connections.mysql.username'),
            'password'   => config('database.connections.mysql.password'),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => 'InnoDB',
        ]);

        Config::set('database.default', 'organization');
        DB::purge('organization');

        //Migrate New database tables.
        Artisan::call('migrate', ['--database' => 'organization', '--path' => 'app/Modules/Organization/database/customMigrations']);
        // Fill new database tables data.
        Config::set('database.default', 'organization');
        //run the seeders here.
        Artisan::call('db:seed', ['--class' => 'OrganizationPermissionSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrganizationRoleSeeder']);
        Artisan::call('db:seed', ['--class' => 'WeekDaySeeder']);
        Artisan::call('db:seed', ['--class' => 'DepartmentSeeder']);
        Artisan::call('db:seed', ['--class' => 'EmployeeTypeSeeder']);
        Artisan::call('db:seed', ['--class' => 'EmployeeJobSeeder']);
        Artisan::call('db:seed', ['--class' => 'EmployeeSeeder']);
        Artisan::call('db:seed', ['--class' => 'AccTypeTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'AccountTypeTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrganizationPermissionArSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrganizationPermissionEnArSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrganizationPermissionInventoryUpdateSeeder']);
        RolePermission::create([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        OrganizationAdmin::create([
            'name'               => $request->input('adminName'),
            'phone'              => $request->input('adminPhone'),
            'email'              => $request->input('adminEmail'),
            'password'           => bcrypt($request->input('adminPassword')),
            'role_id' => 1,
            'employee_id' => 1,
            'organization_id' => $organization
        ]);
    }
}
