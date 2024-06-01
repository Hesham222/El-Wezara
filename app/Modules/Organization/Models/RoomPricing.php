<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RoomPricing extends Model
{
    use SoftDeletes ;

    public function ParentRoom(){

        return $this->belongsTo(ParentRoom::class,'parentRoom_id');
    }

    public function CustomerType(){

        return $this->belongsTo(CustomerType::class,'customerType_id');
    }

    public function RoomType(){

        return $this->belongsTo(RoomType::class,'roomType_id');
    }
}
