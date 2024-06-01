<?php

namespace Organization\Models;


class CartItem extends Model
{
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }


    public function ingredent()
    {
        return $this->belongsTo(Ingredient::class,'component_id','id');

    }

    public function item()
    {
        return $this->belongsTo(Item::class,'component_id','id');

    }

}
