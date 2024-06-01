<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Organization\Models\{Ingredient,
    Item,
    LaundryService,
    LService,
    OrderItem,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaEmployee,
    PreparationAreaInventory};
class MakeItemAction
{
    public function execute($id)
    {
        $order_item = OrderItem::FindOrFail($id);

        $main_prep_area = PreparationArea::FindOrFail($order_item->preparation_area_id);
        $ing  = Item::FindOrFail($order_item->component_id);

        if (!$main_prep_area->checkItem($ing,$order_item->quantity)){
            return 0;
        }
        // sub ingredent from inventory

        if ($order_item->component_type == "Item"){
            foreach ($order_item->item->components as $component){

                if ($component->component_type == "Ingredient")
                {
                    $ing = Ingredient::FindOrFail($component->component_id);

                    $prep_inventory = PreparationAreaInventory::where('area_id',$order_item->preparation_area_id)
                        ->where('ingredient_id',$ing->id)
                        ->first();
                    $prep_inventory->quantity -= $component->quantity*$order_item->quantity;
                    $prep_inventory->save();

                }elseif ($component->component_type == "Item"){

                    $current_item = Item::FindOrFail($component->component_id);
                    foreach ($current_item->components as $current_component){
                        if ($current_component->component_type == "Ingredient")
                        {
                            $ing = Ingredient::FindOrFail($current_component->component_id);

                            $prep_inventory = PreparationAreaInventory::where('area_id',$order_item->preparation_area_id)
                                ->where('ingredient_id',$ing->id)
                                ->first();
                            $prep_inventory->quantity -= $current_component->quantity*$component->quantity;
                            $prep_inventory->save();
                        }

                    }

                }
            }

        }



        $order_item->status = "finished";
        $order_item->save();

        return 1;

    }
}
