<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes ;

    public function CustomerData(){
        return $this->hasMany(ReservationContacts::class,'reservation_id');
    }
    public function CustomerType(){

        return $this->belongsTo(CustomerType::class,'customerType_id');
    }
    public function payments()
    {
        return $this->hasMany(ReservationPayment::class);
    }

    public function reservation_products()
    {
        return $this->hasMany(ReservationProduct::class ,'reservation_id');
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function reservationPrimaryContacts()
    {
        return $this->hasMany(ReservationSecondaryContact::class);
    }

    public function reservationExtraServices()
    {
        return $this->hasMany(ReservationSupplierService::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function reservationSuppliers(){
        return $this->hasMany(ReservationSupplier::class);
    }

    public function ticket()
    {
        return $this->belongsTo(TicketPrice::class,'ticket_price_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function discountType(){

        if ($this->discount_type == "numeric"){
            return "رقمي";
        }elseif ($this->discount_type == "percentage"){
            return "مئوي";
        }else{
            return "لا يوجد" ;
        }

    }

}
