<?php

namespace Organization\Models;


class HotelReservationPayment extends Model
{
    public function reservation()
    {
        return $this->belongsTo(HotelReservation::class,'hotel_reservation_id');
    }
}
