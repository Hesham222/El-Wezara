<?php
namespace Organization\Actions\Item;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\Item;

class UpdateAction
{
    use FileTrait;
    public function execute(Request $request,$id)
    {
        $record         = Item::find($id);
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

            $record->type        = $request->input('type');
            $record->price        = $request->input('price');
            $record->cost       = $request->input('cost');
        $record->menu_category_id       = $request->input('category');

        //upload  image file
        if ($request->file('image')){
            if ($record->image)
            $this->RemoveSingleFile($record->image);

            $record->image =  $this->storeSingleFile($request->file('image'),'items');
        }
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

        return $record;

    }
}
