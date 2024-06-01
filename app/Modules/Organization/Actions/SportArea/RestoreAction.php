<?php
namespace Organization\Actions\SportArea;
use Illuminate\Http\Request;
use Organization\Models\{
    SportActivityAreas
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SportActivityAreas::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
