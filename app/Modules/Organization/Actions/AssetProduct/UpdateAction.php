<?php
namespace Organization\Actions\AssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetProduct
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = AssetProduct::find($id);

        $record->name                        = $request->input('name');
        $record->assetCategory_id            = $request->input('assetCategory_id');
        $record->save();

        return $record;
    }
}
