<?php

namespace Organization\Models;


use Spatie\Translatable\HasTranslations;

class ItemVariant extends Model
{

    use HasTranslations;

    public $translatable = ['name','description'];


    public function components()
    {
        return $this->hasMany(ItemVariantDetail::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');

    }

}
