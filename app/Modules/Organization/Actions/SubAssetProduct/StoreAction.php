<?php
namespace Organization\Actions\SubAssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAssetProduct
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  SubAssetProduct::create([
            'name'                      => $request->input('name'),
            'assetProduct_id'           => $request->input('assetProduct_id'),
            'start_value'               => $request->input('start_value'),
            'current_value'             => $request->input('current_value'),
            'entry_date'                => $request->input('entry_date'),
        ]);

        return $record;
    }
}
