<?php

namespace Organization\Models;


class ItemVariantDetail extends Model
{




    public function item_detail()
    {
        return $this->belongsTo(ItemDetail::class,'item_detail_id','id');

    }



}
