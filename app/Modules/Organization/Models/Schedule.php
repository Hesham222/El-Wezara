<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes ;

    public function Training(){

        return $this->belongsTo(Training::class,'training_id');
    }
}
