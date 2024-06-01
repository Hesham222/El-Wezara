<?php
namespace Organization\Actions\SubAssetProduct;;
use Illuminate\Http\Request;

use Organization\Models\{
    SubAssetProduct
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SubAssetProduct::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
