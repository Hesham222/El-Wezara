<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryService extends Model
{

    public function laundry(){

        return $this->belongsTo(laundry::class,'laundry_id');
    }


    public function lService(){

        return $this->belongsTo(LService::class,'l_service_id');
    }

}
