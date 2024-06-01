<?php

namespace Organization\Models;


class HotelStokingIngredient extends Model
{
    public function stocking()
    {
        return $this->belongsTo(HotelStoking::class, 'stocking_id');
    }

    public function ingredient(){
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }
}
