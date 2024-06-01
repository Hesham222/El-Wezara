<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PreparationAreaInventory extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventoryOrderIngredients(){
        return $this->hasMany(PreparationAreaOrderIngredient::class);
    }
    public function area(){
        return $this->belongsTo(PreparationArea::class,'area_id');
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }



}
