<?php

namespace Organization\Models;


class PreparationAreaInventoryConsumption extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventory(){
        return $this->belongsTo(PreparationAreaInventory::class,'inventory_id');
    }

}
