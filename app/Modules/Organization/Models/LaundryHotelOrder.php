<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryHotelOrder extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function laundry(){

        return $this->belongsTo(laundry::class,'laundry_id');
    }

    public function laundryOrderServices()
    {
        return $this->hasMany(LaundryHotelOrderService::class,'laundry_hotel_order_id');
    }


}
