<?php


namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerData extends Model
{
    use SoftDeletes ;

    public function Customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
