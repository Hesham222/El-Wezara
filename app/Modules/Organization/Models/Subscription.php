<?php


namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function cancelledBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'cancelled_by')->withTrashed();
    }

    public function Subscriber(){

        return $this->belongsTo(Customer::class,'subscriber_id');
    }

    public function Training(){

        return $this->belongsTo(Training::class,'training_id');
    }

    public function Payments(){

        return $this->hasMany(Payment::class,'subscription_id');
    }

    public function Round(){

       return round(( $this->price /  $this->session_balance),2);
    }

}
