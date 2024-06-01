<?php

namespace Organization\Models;


class PointOfSaleRetrievalOrder extends Model
{

    public function sender()
    {
        return $this->belongsTo(PointOfSale::class, 'sender_id');
    }

    public function resever()
    {
        return $this->belongsTo(PointOfSale::class, 'resever_id');
    }

    public function orderIngredents()
    {
        return $this->hasMany(PointOfSaleRetrievalOrderIngredent::class, 'order_id');
    }

}
