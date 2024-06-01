<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PointOfSaleInventory extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventoryOrderIngredients(){
        return $this->hasMany(PointOfSaleOrderIngredient::class);
    }
    public function PointOfSale(){
        return $this->belongsTo(PointOfSale::class,'PointOfSale_id');
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }



}
