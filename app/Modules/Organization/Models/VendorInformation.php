<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class VendorInformation extends Model
{
    use SoftDeletes ;

    public function VendorType(){

        return $this->belongsTo(VendorType::class,'vendorType_id');
    }
}
