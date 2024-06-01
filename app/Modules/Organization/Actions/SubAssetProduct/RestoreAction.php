<?php
namespace Organization\Actions\SubAssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAssetProduct
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SubAssetProduct::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
