<?php
namespace Organization\Actions\Tenant;
use Illuminate\Http\Request;
use Organization\Models\{
    Tenant
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Tenant::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
