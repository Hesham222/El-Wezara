<?php

namespace Organization\Models;


class HotelInventoryConsumption extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventory(){
        return $this->belongsTo(HotelInventory::class,'inventory_id');
    }

}
