<?php
namespace Organization\Actions\PreparationAreaOrder;
use Organization\Models\{LaundryInventory, InventoryOrder, laundry, PreparationArea, PreparationAreaOrder};

class ChangeStatusAction
{
    public function execute($id)
    {
        $record         = PreparationAreaOrder::find($id);
        if($record->status == "pending"){
            $record->status = "received";
        }
        $record->save();
        $area_id = PreparationArea::where('name',$record->area_name)->id;
        if($record->status == "received"){
            LaundryInventory::create([
                'quantity'          =>  $record->OrderIngredients->quantity,
                'ingredient_id'     =>  $record->OrderIngredients->ingredient_id,
                'area_id'        =>  $area_id
            ]);
        }

        return $record->status;
    }
}
