<?php
namespace Organization\Actions\AssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetProduct
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = AssetProduct::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
