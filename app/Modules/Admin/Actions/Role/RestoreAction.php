<?php
namespace Admin\Actions\Role;;
use Illuminate\Http\Request;
use Admin\Models\{
    Role
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Role::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
