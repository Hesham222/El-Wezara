<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => [
                'en' => "Department One",
                'ar' => "القسم الأول",
            ]
        ]);
    }
}
