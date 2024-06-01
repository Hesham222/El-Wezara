<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class VendorType extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function information(){

        return $this->hasMany(VendorInformation::class,'vendorType_id');
    }
}
