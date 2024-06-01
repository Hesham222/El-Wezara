<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ParentRoom extends Model
{
    
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function DayPricings()
    {
        return $this->hasMany(RoomDayPricing::class,'parentRoom_id');
    }

    public function Pricings()
    {
        return $this->hasMany(RoomPricing::class,'parentRoom_id');
    }

    public function Rooms()
    {
        return $this->hasMany(Rooms::class,'parentRoom_id')->where('status','Available');
    }
}
