<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryOrder extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function laundry(){

        return $this->belongsTo(laundry::class,'laundry_id');
    }

    public function laundryOrderSubCategories()
    {
        return $this->hasMany(LaundryOrderSubCategory::class,'laundry_order_id');
    }

    public function laundryOrderServices()
    {
        return $this->hasMany(LaundryOrderService::class,'laundry_order_id');
    }

    public function payments(){
        $this->hasMany(LaundryOrderPayment::class);
    }
}
