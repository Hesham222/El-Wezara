<?php

namespace Organization\Models;


use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
    use SoftDeletes ;


    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    public function payments()
    {
        return $this->hasManyThrough(PurchaseOrderPayment::class,PurchaseOrder::class);
    }

    public function VendorType(){

        return $this->belongsTo(VendorType::class,'vendorType_id');
    }
    public function VendorData(){
        return $this->hasMany(VendorData::class,'vendor_id');
    }

}
