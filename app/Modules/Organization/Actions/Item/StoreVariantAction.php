<?php
namespace Organization\Actions\Item;
use Illuminate\Http\Request;
use Organization\Models\{Item, ItemVariant};
class StoreVariantAction
{
    public function execute(Request $request)
    {
        //return dd($request->all());
        $item = Item::FindOrFail($request->item_id);
        //return dd($item);
        $record =  ItemVariant::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
            'price'        => $request->input('price'),
            'cost'        => $request->input('cost'),
            'item_id'        => $item->id,
        ]);


        if ($request->has('can_sold'))
        {
            $record->auxiliary_materials = $request->input('auxiliary_materials');

            $record->mortal = $request->input('mortal');
            $record->variable_ratio = $request->input('variable_ratio');
            $record->price_options = $request->input('price_options');

            $record->final_cost = $request->input('final_cost');

            if ($request->price_options == 1){
                $record->price = $request->input('final_price');
            }else{
                $record->price = $request->input('final_price_calcued');
            }

            $record->save();

        }

        return $record;
    }
}
