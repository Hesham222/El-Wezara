<?php

namespace Organization\Models;


class PointOfSaleEmployee extends Model
{

    public function PointOfSale(){
        return $this->belongsTo(PointOfSale::class,'PointOfSale_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
