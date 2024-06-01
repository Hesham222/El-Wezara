<?php

namespace Organization\Models;


class OrderPayment extends Model
{



    public function order(){
        return $this->belongsTo(Order::class);
    }


}
