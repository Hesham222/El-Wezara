<?php

namespace Organization\Models;

class ReservationProduct extends Model
{
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'component_id','id');

    }


    public function item_variant()
    {
        return $this->belongsTo(ItemVariant::class,'component_id','id');

    }}
