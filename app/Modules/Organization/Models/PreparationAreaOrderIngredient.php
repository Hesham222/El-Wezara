<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PreparationAreaOrderIngredient extends Model
{


    public function order()
    {
        return $this->belongsTo(PreparationAreaOrder::class,'order_id');
    }


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

}
