<?php

namespace Organization\Models;

class EmployeeAttendance extends Model
{
	protected $table = 'employee_attendancees';
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

 

}