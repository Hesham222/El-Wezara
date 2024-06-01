<?php

namespace Organization\Models;


class ItemDetail extends Model
{
    public function ingredent()
    {
        return $this->belongsTo(Ingredient::class,'component_id','id');

    }

    public function item()
    {
        return $this->belongsTo(Item::class,'component_id','id');

    }


    public function item_variant()
    {
        return $this->belongsTo(ItemVariant::class,'component_id','id');

    }
}
