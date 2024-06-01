<?php
namespace Organization\Actions\Item;
use Organization\Models\Ingredient;
use Organization\Models\Item;
use Organization\Models\ItemDetail;
use Organization\Models\ItemVariant;
use Illuminate\Http\Request;
class AssignIngredientsAction
{
    public function execute(Request $request, $record)
    {

//        $data = $request->removable[0];
//        $type = substr($data, strpos($data, ",") + 1);
//        $remoeID = strtok($data, ',');
      // return dd($request->all());

        if($record->components->count())
           ItemDetail::where('item_id',$record->id)->delete();


        for ($i=0;$i < count($request->ingredients);$i++)
        {
            $variant_ing = 0;
            $variant_item = 0;
            $removable_ing = 0;
            $removable_item = 0;

            $removable_item_variant = 0;



            if ($request->has('removable') && in_array($request->ingredients[$i].',Ingredient' , $request->removable)){
            //   return dd('remov from ings');
                $removable_ing = 1;

            }

            if ($request->has('removable') && in_array($request->ingredients[$i].',Item' , $request->removable)){
              //  return dd('remov from items');
                $removable_item = 1;

            }

            if ($request->has('removable') && in_array($request->ingredients[$i].',Item Variant' , $request->removable)){
               // return dd('remov from variants');
                $removable_item_variant = 1;

            }

            if ($request->has('variant') && in_array($request->ingredients[$i].',Ingredient' , $request->variant)){
                $variant_ing = 1;
            }elseif ($request->has('variant') && in_array($request->ingredients[$i].',Item' , $request->variant))
                $variant_item = 1;

            else{
                ItemVariant::where('item_id',$record->id)->delete();
            }

            if ($request->comType[$i] == 1){
                $ing  = Ingredient::FindOrFail($request->ingredients[$i]);
                ItemDetail::create(
                    [
                        'component_type'=>'Ingredient',
                        'component_id'=>$ing->id,
                        'item_id' => $record->id,
                        'quantity'=>$request->quantities[$i],
                        'removable'=>$removable_ing,
                        'variant'=>$request->input('type') == 'Standard' ? 0 : $variant_ing,
                    ]
                );
            }elseif ($request->comType[$i] == 3){
                $ing  = ItemVariant::FindOrFail($request->ingredients[$i]);
                ItemDetail::create(
                    [
                        'component_type'=>'Item Variant',
                        'component_id'=>$ing->id,
                        'item_id' => $record->id,
                        'quantity'=>$request->quantities[$i],
                        'removable'=>$removable_item_variant,
                        'variant'=>0,
                    ]
                );
            }
            else{
                $ing  = Item::FindOrFail($request->ingredients[$i]);
                ItemDetail::create(
                    [
                        'component_type'=>'Item',
                        'component_id'=>$ing->id,
                        'item_id' => $record->id,
                        'quantity'=>$request->quantities[$i],
                        'removable'=>$removable_item,
                        'variant'=>$request->input('type') == 'Standard' ? 0 : $variant_item,
                    ]
                );
            }


        }
    }
}
