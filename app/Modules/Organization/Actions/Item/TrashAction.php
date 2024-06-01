<?php
namespace Organization\Actions\Item;
use Illuminate\Http\Request;
use Organization\Models\Item;

class TrashAction
{
    public function execute(Request $request)
    {
        $record = Item::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
