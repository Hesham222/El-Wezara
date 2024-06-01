<?php

namespace Organization\Models;


class LaundryStokingIngredient extends Model
{
    public function stocking()
    {
        return $this->belongsTo(LaundryStoking::class, 'stocking_id');
    }

    public function ingredient(){
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }
}
