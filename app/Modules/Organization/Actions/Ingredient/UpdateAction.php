<?php
namespace Organization\Actions\Ingredient;
use Illuminate\Http\Request;
use Organization\Models\Ingredient;

class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = Ingredient::find($id);
        $record->fill([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
        ]);
        $record->quantity  =    $request->input('quantity');
        $record->stock  =    $request->input('stock');
        $record->re_order_quantity  =    $request->input('re_order_quantity');
        $record->unit_measurement_id       = $request->input('unit');
        $record->ingredient_category_id       = $request->input('category');
        $record->cost       = $request->input('cost');
        $record->type       = $request->input('type');
        $record->save();



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

        }else{

            $record->mortal = null;
            $record->variable_ratio = null;
            $record->price_options =null;

            $record->final_cost = null;
            $record->price = null ;
        }


    }
}
