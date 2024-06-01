<?php

namespace Organization\Models;

class PoStokingIngredient extends Model
{
    public function stocking()
    {
        return $this->belongsTo(PoStoking::class, 'stocking_id');
    }

    public function ingredient(){
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }
}
