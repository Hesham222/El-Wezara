<?php
namespace Organization\Actions\Gate;;
use Illuminate\Http\Request;
use Organization\Models\{
    Gate
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Gate::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
