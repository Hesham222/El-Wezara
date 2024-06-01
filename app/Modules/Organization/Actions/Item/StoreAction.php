<?php
namespace Organization\Actions\Item;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\Item;

class StoreAction
{
    use FileTrait;
    public function execute(Request $request)
    {
        //upload  image file
        if ($request->file('image'))
            $image =  $this->storeSingleFile($request->file('image'),'items');
        else
            $image = null;

        $record =  Item::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
            'type'        => $request->input('type'),
            'image'        => $image,
            'price'        => $request->input('price'),
            'cost'        => $request->input('cost'),
            'menu_category_id'        => $request->input('category'),
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
