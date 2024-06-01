<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalPayment extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function Subscriber(){

        return $this->belongsTo(Customer::class,'subscriber_id');
    }

    public function ExternalReservation(){

        return $this->belongsTo(ExternalReservation::class,'external_reservation_id');
    }
}
