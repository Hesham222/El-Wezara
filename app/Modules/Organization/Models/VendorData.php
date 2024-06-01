<?php


namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class VendorData extends Model
{
    use SoftDeletes ;

    public function Vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
