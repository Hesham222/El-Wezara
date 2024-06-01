<?php

namespace Organization\Models;

class EmployeeWorkingDay extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
