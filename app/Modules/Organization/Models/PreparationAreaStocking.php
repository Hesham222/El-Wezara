<?php

namespace Organization\Models;


class PreparationAreaStocking extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'organization_admin_id');
    }


    public function StockingIngredients(){
        return $this->hasMany(PreparationAreaStockingIngredient::class,'stocking_id');
    }
    public function area()
    {
        return $this->belongsTo(PreparationArea::class, 'preparation_area_id');
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
