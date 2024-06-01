<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class ReservationContacts extends Model
{
    use SoftDeletes ;

    public function Reservation(){
        return $this->belongsTo(Reservation::class,'reservation_id');
    }

}
