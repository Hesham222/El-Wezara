<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RoomDamage extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function HotelReservation(){

        return $this->belongsTo(HotelReservation::class,'hotelReservation_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }
}
