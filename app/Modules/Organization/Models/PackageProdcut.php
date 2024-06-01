<?php

namespace Organization\Models;

class PackageProdcut extends Model
{

    public function package()
    {
        return $this->belongsTo(Package::class);
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
