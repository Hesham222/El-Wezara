<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryOrderIngredient extends Model
{


    public function order()
    {
        return $this->belongsTo(InventoryOrder::class,'order_id');
    }


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

}
