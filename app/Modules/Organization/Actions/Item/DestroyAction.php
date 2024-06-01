<?php
namespace Organization\Actions\Item;
use Illuminate\Http\Request;
use Organization\Models\Item;


class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Item::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
