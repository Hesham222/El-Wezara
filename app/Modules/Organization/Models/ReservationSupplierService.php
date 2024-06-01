<?php

namespace Organization\Models;

class ReservationSupplierService extends Model
{

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function supplierService()
    {
        return $this->belongsTo(SupplierService::class);
    }


}
