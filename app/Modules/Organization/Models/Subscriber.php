<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class Subscriber extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function SubscriberType(){

        return $this->belongsTo(SubscribersType::class,'subscriber_type_id');
    }
}
