<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientCategory extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Parent()
    {
        return $this->belongsTo(IngredientCategory::class,'parent_id');
    }
    public function ingredients(){
        return $this->hasMany(Ingredient::class,'ingredient_category_id');
    }

    public function childs()
    {
        return $this->hasMany(IngredientCategory::class,'parent_id');
    }
    public function total(){
        $sum = 0;

        foreach ($this->ingredients as $ingredient){

            $sum += $ingredient->final_cost * $ingredient->stock ;
        }
        return $sum;

    }

    public function generalTotal(){
        $sum = 0;

        foreach ($this->childs as $child){
            foreach ($child->ingredients as $ingredient){
                $sum += $ingredient->final_cost * $ingredient->stock ;
            }
        }
        return $sum;

    }

    public function IngredientOrderTotal(){
        $sum_area = 0;
        $sum_hotel = 0;
        $sum_po = 0;
        $sum_laundry = 0;

        $hotel_orders = HotelOrder::where('status','received')->get();

        foreach ($hotel_orders as $hotel_order){
            foreach ($hotel_order->hotelOrderIngredients as $hotelOrderIngredient){
                if ($hotelOrderIngredient->ingredient->category->id == $this->id){
                    $sum_hotel += $hotelOrderIngredient->quantity * $hotelOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $area_orders = PreparationAreaOrder::where('status','received')->get();

        foreach ($area_orders as $area_order){
            foreach ($area_order->AreaOrderIngredients as $AreaOrderIngredient){
                if ($AreaOrderIngredient->ingredient->category->id == $this->id){
                    $sum_area += $AreaOrderIngredient->quantity * $AreaOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $po_orders = PointOfSaleOrder::where('status','received')->get();

        foreach ($po_orders as $po_order){
            foreach ($po_order->PointOrderIngredients as $PointOrderIngredient){
                if ($PointOrderIngredient->ingredient->category->id == $this->id){
                    $sum_po += $PointOrderIngredient->quantity * $PointOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $laundry_orders = InventoryOrder::where('status','received')->get();

        foreach ($laundry_orders as $laundry_order){
            foreach ($laundry_order->inventoryOrderIngredients as $inventoryOrderIngredient){
                if ($inventoryOrderIngredient->ingredient->category->id == $this->id){
                    $sum_laundry += $inventoryOrderIngredient->quantity * $inventoryOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        return $sum_area + $sum_hotel + $sum_po + $sum_laundry;

    }
}
