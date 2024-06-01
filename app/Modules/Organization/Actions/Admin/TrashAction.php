<?php
namespace Organization\Actions\Admin;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = OrganizationAdmin::where('id', '!=', 1)->where('id', '!=', auth('organization_admin')->user()->id)->find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
