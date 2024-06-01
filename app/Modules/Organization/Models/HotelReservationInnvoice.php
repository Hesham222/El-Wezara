<?php

namespace Organization\Models;


class HotelReservationInnvoice extends Model
{
    public function hotelReservation()
    {
        return $this->belongsTo(HotelReservation::class,'model_id','id');
    }

    public function hotelInvoiceExtra()
    {
        return $this->hasOne(HotelInnvoiceExtra::class,'hotel_reservation_innvoice_id');
    }
}
