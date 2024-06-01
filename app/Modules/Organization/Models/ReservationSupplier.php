<?php

namespace Organization\Models;

class ReservationSupplier extends Model
{

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }


}
