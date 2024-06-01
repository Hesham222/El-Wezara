<?php

namespace Organization\Models;


class OrderItem extends Model
{

    public function order()
    {
        return $this->belongsTo(Order::class);

    }

    public function point_of_sale()
    {
        return $this->belongsTo(PointOfSale::class);

    }


    public function prep_area()
    {
        return $this->belongsTo(PreparationArea::class,'preparation_area_id','id');

    }

    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);

    }

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
