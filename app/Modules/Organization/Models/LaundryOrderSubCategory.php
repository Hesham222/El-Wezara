<?php

namespace Organization\Models;

class LaundryOrderSubCategory extends Model
{

    public function laundrySubCategory()
    {
        return $this->belongsTo(LaundrySubCategory::class);
    }



    public function laundryOrder()
    {
        return $this->belongsTo(LaundryOrder::class,);
    }


}
