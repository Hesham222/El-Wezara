<?php

namespace Organization\Models;


class AreaRetrievalOrderIngredent extends Model
{

    public function order()
    {
        return $this->belongsTo(PreparationAreaRetrievalOrder::class, 'order_id');
    }

    public function Ingredent()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

}
