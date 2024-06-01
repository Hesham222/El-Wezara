<?php

namespace Organization\Models;

class RoomLoss extends Model
{
    
    public function room()
    {
        return $this->belongsTo(Rooms::class,'room_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }
}
