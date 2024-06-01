<?php
namespace Organization\Actions\SubAssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAssetProduct
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = SubAssetProduct::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
