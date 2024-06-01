<?php

namespace Organization\Models;


class PreparationAreaEmployee extends Model
{

    public function preparationArea(){
        return $this->belongsTo(PreparationArea::class,'area_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
