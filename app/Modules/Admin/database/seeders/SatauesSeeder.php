<?php

use Admin\Models\Status;
use Illuminate\Database\Seeder;
use Admin\Models\Service;

class SatauesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'مفتوح',
            'color'=>'#007bff'
        ]);

        Status::create([
            'name' => 'تم الطلب',
            'color'=>'#545b62'
        ]);

        Status::create([
            'name' => 'تم الاستلام',
            'color'=>'#d39e00'
        ]);

        Status::create([
            'name' => 'تمت العملية',
            'color'=>'#1e7e34'
        ]);
        Status::create([
            'name' => 'تمت الالغاء',
            'color'=>'#bd2130'
        ]);

    }
}
