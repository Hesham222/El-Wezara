<?php

namespace Organization\Models;

class PackageItem extends Model
{

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function item()
    {
        return $this->belongsTo(EventItem::class);
    }

}
