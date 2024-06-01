<?php
namespace Organization\Actions\Hall;
use Illuminate\Http\Request;
use Organization\Models\{
    Hall
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Hall::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
