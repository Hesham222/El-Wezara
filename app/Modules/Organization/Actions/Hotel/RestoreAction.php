<?php
namespace Organization\Actions\Hotel;
use Illuminate\Http\Request;
use Organization\Models\{
    Hotel
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Hotel::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
