<?php

namespace Organization\Models;


class PreparationAreaStockingIngredient extends Model
{



    public function stocking()
    {
        return $this->belongsTo(PreparationAreaStocking::class, 'stocking_id');
    }

    public function ingredient(){
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }


}
