<?php

use Admin\Models\Organization;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'as' => 'admins.'], function () {
    app()->setLocale('ar');
   // Config::set('database.default', 'mysql');

    Route::get('login', 'AuthController@checkLogin')->name('login');
    Route::post('login', 'AuthController@login')->middleware('throttle:6,1');

    Route::middleware('privilege:admin')->group(function () {
        //Config::set('database.default', 'mysql');
        Route::get('/', 'DashboardController')->name('home');
        /**
         * Admin Module Routes
         */

        // command for migrate new tables in already exists organization DBs

        Route::get('migrate/new/tables',function (){

            $orgs = \Admin\Models\Organization::all();
            foreach ($orgs as $org){
                //Change the default DB configration to the current  database created for this organization.
                Config::set('database.connections.organization', [
                    'driver'     => 'mysql',
                    'host'       => config('database.connections.mysql.host'),
                    'database'   => 'organization_' . $org->id,
                    'username'   => config('database.connections.mysql.username'),
                    'password'   => config('database.connections.mysql.password'),
                ]);

                //Migrate New database tables.
                Artisan::call('migrate', ['--database' => 'organization', '--path' => 'app/Modules/Organization/database/newMigrations']);
                \Illuminate\Support\Facades\DB::purge('organization');
                //\Illuminate\Support\Facades\DB::reconnect('mysql');
            }

            Config::set('database.default', 'elwezara');

            return 'migration finished !';

        });





        Route::get('run/org_id/script',function (){

            $organization_ids = Organization::pluck('id');
            foreach ($organization_ids as $organization_id)
            {
                $db = DBConnection($organization_id);

                $all_admins = $db->table('organization_admins')->pluck('id');

                foreach ($all_admins as $admin)
                {


                    DB::table('organization_admins')
                        ->where('id', $admin)
                        ->update(['organization_id' => $organization_id]);


                }



            }

            DB::purge('organization');
            Config::set('database.default', env('DB_CONNECTION', 'mysql'));

            return 'script finished successfully';

        });





        Route::get('seed/new',function (){

            $orgs = \Admin\Models\Organization::all();
            //return $orgs;
            foreach ($orgs as $org){
                //Change the default DB configration to the current  database created for this organization.
                Config::set('database.connections.organization', [
                    'driver'     => 'mysql',
                    'host'       => config('database.connections.mysql.host'),
                    'database'   => 'organization_' . $org->id,
                    'username'   => config('database.connections.mysql.username'),
                    'password'   => config('database.connections.mysql.password'),
                ]);

                //Seed New .
                Artisan::call('db:seed', ['--database' => 'organization','--class' => 'OrganizationPermissionArSeeder']);
                Artisan::call('db:seed', ['--database' => 'organization','--class' => 'OrganizationPermissionEnArSeeder']);
                Artisan::call('db:seed', ['--database' => 'organization','--class' => 'OrganizationPermissionInventoryUpdateSeeder']);

                \Illuminate\Support\Facades\DB::purge('organization');
                //\Illuminate\Support\Facades\DB::reconnect('mysql');
            }

            Config::set('database.default', 'elwezara');

            return 'seed finished !';

        });




        Route::resource('admin', 'AdminController');
        Route::prefix('admins')->group(function () {
            Route::as('admin.')->group(function () {
                Route::get('data', 'AdminController@data')->name('data');
                Route::post('reset/password', 'AdminController@resetPassword')->name('reset.password');
                Route::post('trash', 'AdminController@trash')->name('trash');
                Route::post('restore', 'AdminController@restore')->name('restore');
                Route::get('export', 'AdminController@export')->name('export');
            });
        });

        Route::resource('role', 'RoleController');
        Route::prefix('roles')->group(function () {
            Route::as('role.')->group(function () {
                Route::get('data', 'RoleController@data')->name('data');
                Route::post('trash', 'RoleController@trash')->name('trash');
                Route::post('restore', 'RoleController@restore')->name('restore');
                Route::get('export', 'RoleController@export')->name('export');
            });
        });

        Route::resource('organization', 'OrganizationController');
        Route::prefix('organizations')->group(function () {
            Route::as('organization.')->group(function () {
                Route::get('login/portal/{id}', 'OrganizationController@login')->name('login');
                Route::get('data', 'OrganizationController@data')->name('data');
                Route::post('trash', 'OrganizationController@trash')->name('trash');
                Route::post('restore', 'OrganizationController@restore')->name('restore');
                Route::get('export', 'OrganizationController@export')->name('export');
            });
        });




        Route::get('events-dashboard', 'EventDashboardController')->name('events-home');
        Route::get('hr-dashboard', 'HRDashboardController')->name('hr-home');
        Route::get('rents-dashboard', 'RentDashboardController')->name('rents-home');
        Route::get('sports-activities-dashboard', 'SportActivityDashboardController')->name('sports-activities-home');
        Route::as('calendar.')->group(function () {
            Route::get('view', 'CalendarController')->name('view');
        });


            /**
         * Logout..
         */
        Route::get('logout', 'AuthController@logout')->name('logout');
    });
});

