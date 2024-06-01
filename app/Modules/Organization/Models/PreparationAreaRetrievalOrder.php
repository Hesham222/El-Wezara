<?php

namespace Organization\Models;


class PreparationAreaRetrievalOrder extends Model
{

    public function sender()
    {
        return $this->belongsTo(PreparationArea::class, 'sender_id');
    }

    public function resever()
    {
        return $this->belongsTo(PreparationArea::class, 'resever_id');
    }

    public function orderIngredents()
    {
        return $this->hasMany(AreaRetrievalOrderIngredent::class, 'order_id');
    }

}
