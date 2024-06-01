<?php

namespace Organization\Models;


class PointOfSaleItems extends Model
{

    public function PointOfSale(){
        return $this->belongsTo(PointOfSale::class,'PointOfSale_id');
    }

    public function employee(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
