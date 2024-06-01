<?php
namespace Organization\Actions\Item;
use Organization\Models\Item;
use Organization\Models\ItemDetail;
use Organization\Models\ItemVariantDetail;
use Illuminate\Http\Request;
class AssignIngredientsVariantAction
{
    public function execute(Request $request, $record)
    {


    $item = Item::FindOrFail($request->item_id);

      //  dd($request->variant);
        for ($i=0;$i < count($request->variant);$i++)
        {

            $item_detail = ItemDetail::where('id',$request->variant[$i])->first();

            ItemVariantDetail::create([
                'item_variant_id' => $record->id,
                'item_detail_id'=>$request->variant[$i],
                'quantity'=>$request->quantities[$i],
                'removable'=>$item_detail->removable,
                'variant'=>$item_detail->variant,
            ]);
        }
    }
}
