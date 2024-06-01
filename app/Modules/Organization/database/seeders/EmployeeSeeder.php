<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Mahmoud Seif',
            'department_id' => 1,
            'employee_type_id' => 1,
            'employee_job_id' => 1,
            'phone' => "01124614208",
            'date_of_hiring' => "2019-12-15",
            'birth_date' => "1993-08-03",
            'social_status' => "Single",
            'address' => "Egypt Cairo",
            'military_status' => "Exempted",
            'gross_salary' => "15000",
            /*'taxes_type' => "Percentage",
            'taxes_value' => "2",
            'insurance_type' => "Number",
            'insurance_value' => "3000",*/
            'net_salary' => "12000",
            'isSystemUser' => 1
        ]);
    }
}
