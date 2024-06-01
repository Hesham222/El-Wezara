<?php
namespace Organization\Actions\Role;;
use Illuminate\Http\Request;
use Organization\Models\{
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
