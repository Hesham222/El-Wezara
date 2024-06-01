<?php

namespace Organization\Models;



class EmployeeAttachment extends Model
{

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
