<?php

namespace Organization\Models;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class IngredentQuantity extends Model
{


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }


}
