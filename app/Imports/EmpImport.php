<?php

namespace App\Imports;

use Organization\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Organization\Models\Department;
use Organization\Models\EmployeeJob;
use Organization\Models\EmployeeType;

class EmpImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

$dept = Department::where('id', $row['department_id'])->first();
if(!$dept){
    abort(401);
}

$emp_type = EmployeeType::where('id', $row['employee_type_id'])->first();



if(!$emp_type){
    abort(401);
}


$emp_job = EmployeeJob::where('id', $row['employee_job_id'])->first();

if(!$emp_job){
    abort(401);
}

        return new Employee([
            'name'     => $row['name'],
            'department_id'     => $row['department_id'],
            'employee_type_id'    => $row['employee_type_id'],
            'employee_job_id' =>$row['employee_job_id'],
            'phone' =>$row['phone'],
            'date_of_hiring' =>$row['date_of_hiring'],
            'birth_date' =>$row['birth_date'],
            'social_status' =>$row['social_status'],
            'address' =>$row['address'],
            'military_status' =>$row['military_status'],
        ]);
    }
}
