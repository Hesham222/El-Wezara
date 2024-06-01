<?php

namespace Organization\Models;


class PointOfSaleRetrievalOrderIngredent extends Model
{

    public function order()
    {
        return $this->belongsTo(PointOfSaleRetrievalOrder::class, 'order_id');
    }

    public function Ingredent()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

}
