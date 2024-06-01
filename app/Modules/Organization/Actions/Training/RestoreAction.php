<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Training
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Training::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
