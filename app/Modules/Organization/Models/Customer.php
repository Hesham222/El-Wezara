<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function Payments(){

        return $this->hasMany(Payment::class,'subscriber_id');
    }
    public function CustomerType(){

        return $this->belongsTo(CustomerType::class,'customerType_id');
    }
    public function CustomerData(){
        return $this->hasMany(CustomerData::class,'customer_id');
    }

    public function Attendances(){

        return $this->hasMany(SubscriberAttendance::class,'subscriber_id');
    }

    public function Subscriptions(){

        return $this->hasMany(Subscription::class,'subscriber_id');
    }
    public function ExternalReservations(){

        return $this->hasMany(ExternalReservation::class,'subscriber_id');
    }
    public function HotelReservations(){

        return $this->hasMany(HotelReservation::class,'customer_id');
    }

    public function Reservations(){

        return $this->hasMany(Reservation::class,'customer_id');
    }
}
