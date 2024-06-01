<?php
namespace Organization\Actions\Role;
use Illuminate\Http\Request;
use Organization\Models\{
    Role
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Role::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
