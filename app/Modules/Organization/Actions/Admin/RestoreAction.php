<?php
namespace Organization\Actions\Admin;;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = OrganizationAdmin::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
