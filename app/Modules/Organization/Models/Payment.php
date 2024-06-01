<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Subscriber(){

        return $this->belongsTo(Customer::class,'subscriber_id');
    }

    public function Subscription(){

        return $this->belongsTo(Subscription::class,'subscription_id');
    }

}
