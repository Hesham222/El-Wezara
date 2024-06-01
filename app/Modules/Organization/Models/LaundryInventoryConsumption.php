<?php

namespace Organization\Models;


class LaundryInventoryConsumption extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventory(){
        return $this->belongsTo(LaundryInventory::class,'inventory_id');
    }

}
