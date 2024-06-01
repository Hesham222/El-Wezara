<?php

namespace Organization\Models;

class ReservationSecondaryContact extends Model
{

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function SecondaryContact()
    {
        return $this->belongsTo(SecondaryContact::class);
    }

}
