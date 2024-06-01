<?php

namespace Organization\Models;


class LaundryStoking extends Model
{
    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'organization_admin_id');
    }

    public function StockingIngredients(){
        return $this->hasMany(LaundryStokingIngredient::class,'stocking_id');
    }
    public function laundry()
    {
        return $this->belongsTo(laundry::class, 'laundry_id');
    }


    public function totalAfter(){
        $sum = 0;

        foreach ($this->StockingIngredients as $ingredient){

            $sum += $ingredient->quantity_after * $ingredient->ingredient->final_cost ;
        }
        return $sum;

    }

    public function totalBefore(){
        $sum = 0;

        foreach ($this->StockingIngredients as $ingredient){

            $sum += $ingredient->quantity_before * $ingredient->ingredient->final_cost ;
        }
        return $sum;

    }
}
