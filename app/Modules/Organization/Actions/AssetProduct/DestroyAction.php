<?php
namespace Organization\Actions\AssetProduct;;
use Illuminate\Http\Request;

use Organization\Models\{
    AssetProduct
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = AssetProduct::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
