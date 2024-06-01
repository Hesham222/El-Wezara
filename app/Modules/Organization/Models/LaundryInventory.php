<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryInventory extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function inventoryOrderIngredients(){
        return $this->hasMany(InventoryOrderIngredient::class);
    }
    public function laundry(){
        return $this->belongsTo(laundry::class,'laundry_id');
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }



}
