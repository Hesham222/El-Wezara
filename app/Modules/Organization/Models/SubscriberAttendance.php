<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriberAttendance extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function getAttendance()
    {
        return $this->attendance == '1' ? 'حضر'  : 'غائب' ;
    }

    public function FreelanceTrainer(){

        return $this->belongsTo(FreelanceTrainer::class,'freelance_trainer_id');
    }

    public function Training(){

        return $this->belongsTo(Training::class,'training_id');
    }
    public function Subscription(){

        return $this->belongsTo(Subscription::class,'subscription_id');
    }

    public function Subscriber(){

        return $this->belongsTo(Customer::class,'subscriber_id');
    }
}
