<?php
namespace Organization\Actions\AssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetProduct
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  AssetProduct::create([
            'name'                      => $request->input('name'),
            'assetCategory_id'          => $request->input('assetCategory_id'),
        ]);

        return $record;
    }
}
