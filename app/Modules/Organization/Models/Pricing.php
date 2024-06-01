<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{
    use SoftDeletes ;

    public function SubscriberType(){

        return $this->belongsTo(CustomerType::class,'subscriber_type_id');
    }

    public function Training(){

        return $this->belongsTo(Training::class,'training_id');

    }
}
