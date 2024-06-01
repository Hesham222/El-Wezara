<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use SoftDeletes ;

    protected $table = 'rooms';

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ParentRoom(){

        return $this->belongsTo(ParentRoom::class,'parentRoom_id');
    }

    public function reservations()
    {
        return $this->hasMany(HotelReservation::class,'room_id');
    }
}
