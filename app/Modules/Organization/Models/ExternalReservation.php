<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalReservation extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ExternalPricing(){

        return $this->belongsTo(ExternalPricing::class,'external_pricing_id');
    }
    public function Subscriber(){

        return $this->belongsTo(Customer::class,'subscriber_id');
    }
}
