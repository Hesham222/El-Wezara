<?php

namespace Organization\Models;
use Admin\Models\Model;

class VendorIngredient extends Model
{
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Vendor(){

        return $this->belongsTo(Vendor::class,'vendor_id');
    }
    public function Ingredient(){

        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }
}
