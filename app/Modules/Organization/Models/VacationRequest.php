<?php

namespace Organization\Models;



class VacationRequest extends Model
{

public function employee()
{
    return $this->belongsTo(Employee::class);
}

    public function vacation_type()
    {
        return $this->belongsTo(EmployeeVacationType::class,'employee_vacation_type_id','id');
    }

}
