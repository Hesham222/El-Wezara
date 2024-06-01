<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class HotelOrderIngredient extends Model
{


    public function order()
    {
        return $this->belongsTo(HotelOrder::class,'order_id');
    }


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

}
