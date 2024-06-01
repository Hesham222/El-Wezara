<?php

namespace Organization\Models;


class InventoryStokingIngredient extends Model
{
    public function stocking()
    {
        return $this->belongsTo(InventoryStoking::class, 'stocking_id');
    }

    public function ingredient(){
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }
}
