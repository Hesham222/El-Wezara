<?php
namespace Organization\Actions\AssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetProduct
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = AssetProduct::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
