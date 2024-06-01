<?php

use Illuminate\Database\Seeder;
use Admin\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        /*Service::create([
            'name' => 'All'
        ]);

        Service::create([
            'name' => 'Club'
        ]);

        Service::create([
            'name' => 'Hotel'
        ]);

        Service::create([
            'name' => 'Gates'
        ]);*/


        Service::create([
            'name' => 'Component'
        ]);


        Service::create([
            'name' => 'Events'
        ]);

        Service::create([
            'name' => 'Finance'
        ]);

        Service::create([
            'name' => 'Hr'
        ]);

        Service::create([
            'name' => 'Laundry'
        ]);


        Service::create([
            'name' => 'Rent'
        ]);

        Service::create([
            'name' => 'Activity'
        ]);

    }
}
