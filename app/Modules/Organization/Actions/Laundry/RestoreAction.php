<?php
namespace Organization\Actions\Laundry;
use Illuminate\Http\Request;
use Organization\Models\{
    laundry
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = laundry::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
