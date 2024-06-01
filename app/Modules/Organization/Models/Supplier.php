<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function reservationSuppliers(){
        return $this->hasMany(ReservationSupplier::class);
    }

    public function hotelReservations(){

        return $this->hasMany(HotelReservation::class,'supplier_id');
    }

    public function roomNights(){
        foreach ($this->hotelReservations as $hotelReservation){
                $count = $hotelReservation->num_of_nights ;

            return $count;
        }
    }
}
