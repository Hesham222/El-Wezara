<?php
namespace Organization\Actions\Vendor;
use Illuminate\Http\Request;
use Organization\Models\{
    Vendor
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Vendor::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
