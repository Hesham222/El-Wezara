<?php

namespace Organization\Models;


class PointOfSaleInventoryConsumption extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventory(){
        return $this->belongsTo(PointOfSaleInventory::class,'inventory_id');
    }

}
