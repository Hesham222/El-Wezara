<?php
namespace Organization\Actions\Ingredient;
use Illuminate\Http\Request;
use Organization\Models\Ingredient;

class StoreAction
{
    public function execute(Request $request): void
    {
        if ($request->has('ing_id')){

            $record =  Ingredient::create([
                'name' => [
                    'en' => $request->input('name_en'),
                    'ar' => $request->input('name_ar'),
                ],
                'description'      => [
                    'en' => $request->input('description_en'),
                    'ar' => $request->input('description_ar'),
                ],
                'quantity'      => $request->input('quantity'),
                'stock'      => $request->input('stock'),
                're_order_quantity'      => $request->input('re_order_quantity'),
                'unit_measurement_id'       => $request->input('unit'),
                'ingredient_category_id'       => $request->input('category'),
                'cost'       => $request->input('cost'),
                'type'       => $request->input('type'),
                'main'       => 0,
                'ingredient_id'       => $request->input('ing_id'),
            ]);

        }else{

            $record =  Ingredient::create([
                'name' => [
                    'en' => $request->input('name_en'),
                    'ar' => $request->input('name_ar'),
                ],
                'description'      => [
                    'en' => $request->input('description_en'),
                    'ar' => $request->input('description_ar'),
                ],
                'quantity'      => $request->input('quantity'),
                'stock'      => $request->input('stock'),
                're_order_quantity'      => $request->input('re_order_quantity'),
                'unit_measurement_id'       => $request->input('unit'),
                'ingredient_category_id'       => $request->input('category'),
                'cost'       => $request->input('cost'),
                'type'       => $request->input('type'),
            ]);

        }



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


    }
}
