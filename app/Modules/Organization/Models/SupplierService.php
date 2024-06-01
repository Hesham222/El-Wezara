<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierService extends Model
{
    use SoftDeletes ;

    public function supplier(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

}
