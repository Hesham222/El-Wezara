<?php
namespace Admin\Actions\Organization;;
use Illuminate\Http\Request;
use Admin\Models\{
    Organization
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Organization::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
