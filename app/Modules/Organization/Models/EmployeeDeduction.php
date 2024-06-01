<?php

namespace Organization\Models;



class EmployeeDeduction extends Model
{

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
