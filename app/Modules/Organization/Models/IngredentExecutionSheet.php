<?php

namespace Organization\Models;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class IngredentExecutionSheet extends Model
{


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }


    public function admin()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin','created_by');
    }


}