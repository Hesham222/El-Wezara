<?php
namespace Organization\Actions\Item;
use Illuminate\Http\Request;
use Organization\Models\Item;


class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Item::onlyTrashed()->find($request->resource_id);

        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
