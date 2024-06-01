<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class External extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function SubscriberType(){

        return $this->belongsTo(CustomerType::class,'subscriber_type_id');
    }
    public function ExternalPricing(){

        return $this->belongsTo(ExternalPricing::class,'external_pricing_id');

    }
}
