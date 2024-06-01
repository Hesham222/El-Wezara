<?php

namespace Organization\Models;



class FinancialAdvanceRequest extends Model
{

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
