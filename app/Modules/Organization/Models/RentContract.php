<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RentContract extends Model
{
    use SoftDeletes ;

    public function tenant()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }

    public function rentSpace()
    {
        return $this->belongsTo(RentSpace::class);
    }

    public function contractPayments()
    {
        return $this->hasMany(RentContractPayment::class);
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
}
