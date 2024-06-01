<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryEmployee extends Model
{
    use SoftDeletes ;

    public function employee(){

        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function laundry(){

        return $this->belongsTo(laundry::class,'laundry_id');
    }

}
