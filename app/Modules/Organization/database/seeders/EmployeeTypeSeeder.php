<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\EmployeeType;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeType::create([
            'name' => [
                'en' => "Type One",
                'ar' => "النوع الأول",
            ]
        ]);
    }
}
