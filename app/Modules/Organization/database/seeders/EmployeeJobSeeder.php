<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\EmployeeJob;

class EmployeeJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeJob::create([
            'name' => "الوظيفة الأولي"
        ]);
    }
}
