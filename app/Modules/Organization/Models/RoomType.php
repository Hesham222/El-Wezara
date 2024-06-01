<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function hotelReservations(){

        return $this->hasMany(HotelReservation::class,'roomType_id');
    }
}
