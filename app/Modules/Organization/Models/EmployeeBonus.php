<?php

namespace Organization\Models;



class EmployeeBonus extends Model
{

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
