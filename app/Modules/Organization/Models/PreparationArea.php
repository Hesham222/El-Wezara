<?php

namespace Organization\Models;


class PreparationArea extends Model
{
    public function PreparationAreaCategories(){
        return $this->hasMany(PreparationAreaCategory::class, 'area_id');
    }

    public function PreparationAreaEmployees(){
        return $this->hasMany(PreparationAreaEmployee::class, 'area_id');
    }

    public function PreparationAreaInventories(){
        return $this->hasMany(PreparationAreaInventory::class, 'area_id');
    }
    public function manager(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function order_items(){

        return $this->hasMany(OrderItem::class)->where('status','preparing');
    }

    public function notification_count()
    {

        $notfy_count = Notification::where('model_type','PreparationArea')->where('model_id',$this->id)->where('seen',0)->count();

        return $notfy_count ;

    }

    public function checkIngredent($ing,$quantity)
    {

        $prep_inventory = PreparationAreaInventory::where('area_id',$this->id)
            ->where('ingredient_id',$ing->id)
            ->where('quantity','>=',$quantity)
            ->first();

       if ($prep_inventory){
           return 1;
       }else{
           return 0;
       }

    }

    public function checkItem($item,$quantity)
    {


        foreach ($item->components as $component){

            if ($component->component_type == "Ingredient")
            {
                $ing = Ingredient::FindOrFail($component->component_id);
               $res = $this->checkIngredent($ing,$component->quantity*$quantity);
               if ($res){
                   continue;
               }else{
                   return 0;
               }
            }elseif ($component->component_type == "Item"){

                $current_item = Item::FindOrFail($component->component_id);
                foreach ($current_item->components as $current_component){
                    if ($current_component->component_type == "Ingredient")
                    {
                        $ing = Ingredient::FindOrFail($current_component->component_id);
                        $res = $this->checkIngredent($ing,$current_component->quantity*$quantity);
                        if ($res){
                            continue;
                        }else{
                            return 0;
                        }
                    }

                }

            }
        }

        return 1;
    }

    public function shortcomings($item,$quantity)
    {
        $making_order = new PreparationAreaOrder();
        $making_order->area_id = $this->id;
        $making_order->created_by = auth('organization_admin')->user()->id;
        $making_order->status = "pending";
        $making_order->save();

        foreach ($item->components as $component){



            if ($component->component_type == "Ingredient")
            {
                $ing = Ingredient::FindOrFail($component->component_id);
                $res = $this->checkIngredent($ing,$component->quantity*$quantity);
                if ($res){
                    continue;
                }else{






                    $prep_inventory = PreparationAreaInventory::where('area_id',$this->id)
                        ->where('ingredient_id',$ing->id)
                        ->first();

                    $prep_order_ing = new PreparationAreaOrderIngredient();
                    $prep_order_ing->quantity = $quantity - $prep_inventory->quantity;
                    $prep_order_ing->ingredient_id  = $ing->id;
                    $prep_order_ing->inventory_order_id = $making_order->id;
                    $prep_order_ing->save();
                    //return 0;
                }
            }elseif ($component->component_type == "Item"){

                $current_item = Item::FindOrFail($component->component_id);
                foreach ($current_item->components as $current_component){
                    if ($current_component->component_type == "Ingredient")
                    {
                        $ing = Ingredient::FindOrFail($current_component->component_id);
                        $res = $this->checkIngredent($ing,$current_component->quantity*$quantity);
                        if ($res){
                            continue;
                        }else{


                            $prep_inventory = PreparationAreaInventory::where('area_id',$this->id)
                                ->where('ingredient_id',$ing->id)
                                ->first();

                            $prep_order_ing = new PreparationAreaOrderIngredient();
                            $prep_order_ing->quantity = $quantity - $prep_inventory->quantity;
                            $prep_order_ing->ingredient_id  = $ing->id;
                            $prep_order_ing->inventory_order_id = $making_order->id;
                            $prep_order_ing->save();
                        }
                    }

                }

            }
        }

    }


}
