<?php
namespace Organization\Actions\InventoryOrder;
use Organization\Models\{LaundryInventory, InventoryOrder, laundry};

class ChangeStatusAction
{
    public function execute($id)
    {
        $record         = InventoryOrder::find($id);
        if($record->status == "pending"){
            $record->status = "received";
        }
        $record->save();
        $laundry_id = laundry::where('name',$record->laundry_name)->id;
        if($record->status == "received"){
            LaundryInventory::create([
                'quantity'          =>  $record->OrderIngredients->quantity,
                'ingredient_id'     =>  $record->OrderIngredients->ingredient_id,
                'laundry_id'        =>  $laundry_id
            ]);
        }

        return $record->status;
    }
}
