<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInformation extends Model
{
    use SoftDeletes ;

    public function CustomerType(){

        return $this->belongsTo(CustomerType::class,'customerType_id');
    }
}
